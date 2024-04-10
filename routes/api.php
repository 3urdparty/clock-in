<?php

use PhpMqtt\Client\Facades\MQTT;
use App\Http\Controllers\Api\DeviceController;
use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\FingerprintController;
use App\Http\Controllers\Api\ShiftController;
use App\Models\Fingerprint;
use App\Models\FingerprintAction;
use App\Models\Shift;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Queue\Events\JobQueued;
use Illuminate\Queue\Jobs\Job;
use Illuminate\Support\Facades\Route;
use PhpMqtt\Client\MqttClient;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('employees', EmployeeController::class);

Route::apiResource('devices', DeviceController::class);

Route::apiResource('devices.employees', DeviceController::class)->scoped([
    'device' => 'id',
    'employees' => 'id'
]);

Route::apiResource('shifts', ShiftController::class);

Route::apiResource('fingerprints', FingerprintController::class);


Route::get('statistics', function () {
    $shifts_in_last_7_days = Shift::all()->where('date', '>=', now()->sub('7 days')->toDateString());
    $shifts_in_previous_7_days = Shift::all()->where('date', '>=', now()->sub('7 days')->toDateString())->where('date', '<', now()->sub('7 days')->toDateString());
    return response()->json([
        'stats' => [
            [
                "name" => "Total Shifts",
                "stat" => $shifts_in_last_7_days->count(),
                "previousStat" => $shifts_in_previous_7_days->count(),
                "changeType" => $shifts_in_last_7_days->count() > $shifts_in_previous_7_days->count() ? "increase" : "decrease",
                "change" => ($shifts_in_last_7_days->count() - $shifts_in_previous_7_days->count()) / ($shifts_in_previous_7_days->count() + 1) * 100,
            ],
            [
                "name" => "Total Hours",
                "stat" => $shifts_in_last_7_days->sum('duration') . 'hrs',
                "previousStat" => $shifts_in_previous_7_days->sum('duration') . 'hrs',
                "changeType" => $shifts_in_last_7_days->sum('duration') > $shifts_in_previous_7_days->sum('duration') ? "increase" : "decrease",
                "change" => ($shifts_in_last_7_days->sum('duration') - $shifts_in_previous_7_days->sum('duration')) / ($shifts_in_previous_7_days->count() + 1) * 100,
            ],
            [
                "name" => "Average Shift Duration",
                "stat" => $shifts_in_last_7_days->average('duration') . 'hrs',
                "previousStat" => $shifts_in_previous_7_days->average('duration') . 'hrs',
                "changeType" => $shifts_in_last_7_days->average('duration') > $shifts_in_previous_7_days->average('duration') ? "increase" : "decrease",
                "change" => ($shifts_in_last_7_days->average('duration') - $shifts_in_previous_7_days->average('duration')) / ($shifts_in_previous_7_days->average('duration') + 1) * 100,
            ],
        ],
        'barchart' => [
            'last_7_days' => [
                'total' => $shifts_in_last_7_days->sum('duration'),
                'change' => ($shifts_in_last_7_days->sum('duration') - $shifts_in_previous_7_days->sum('duration')) / ($shifts_in_previous_7_days->sum('duration') + 1) * 100,
                'average' => $shifts_in_last_7_days->avg('duration'),
                'utilization_rate' => $shifts_in_last_7_days->sum('duration') / (24 * 60 * 60 * 7) * 100,
                'current' => collect([6, 5, 4, 3, 2, 1, 0])->map(function ($days_ago) use ($shifts_in_last_7_days) {
                    return [
                        'x' => now()->sub("$days_ago day")->startOfDay()->format('l')[0], 'y' => $shifts_in_last_7_days->where('date', now()->sub("$days_ago day")->toDateString())->sum('duration')
                    ];
                }),
                'previous' => collect([6, 5, 4, 3, 2, 1, 0])->map(function ($days_ago) use ($shifts_in_previous_7_days) {
                    return [
                        'x' => now()->sub("$days_ago day")->startOfDay()->format('l')[0], 'y' => $shifts_in_previous_7_days->where('date', now()->sub("$days_ago day")->toDateString())->sum('duration')
                    ];
                }),
            ]
        ]
    ]);
});


Route::get('calendar', function (Request $request) {

    $week_number = $request->week_number;
    $shifts = Shift::with(['employee.user'])->get()->append(['week_number', 'week_day']);
    if ($week_number === null) {
        $mapped_by_week_number = $shifts->groupBy('week_number');
        $mapped = $mapped_by_week_number->mapWithKeys(fn ($shifts, $week_number) => [$week_number => $shifts->groupBy('week_day')]);
        return response()->json($mapped);
    } else {
        $shifts = $shifts->filter(fn (Shift $shift) => Carbon::parse($shift->date)->weeksInYear() == $week_number);
        return response()->json($shifts);
    }
});


Route::apiResource('employees.fingerprints', FingerprintController::class);

Route::post('/scan', function (Request $request) {
    $fingerprintId = $request->fingerprint_id;
    $fingerprint = Fingerprint::find($fingerprintId);
    $employee = $fingerprint->employee;
    if ($employee->status == 'online') {
        $employee->completeCurrentShift();
        return response()->json([

            "message" => "Clocked Out successfully at " . now()->hour . ":" . now()->minute,
            "time" => now()->hour . ":" . now()->minute,
            "duration" => now()->hour - $employee->recentShift->start,
            "action" => "clock-out",
            "fingerprint_id" => $fingerprintId,
            "name" => $employee->user->name,
        ]);
    } else {
        $newShift = Shift::create([
            'start' => now()->hour,
            'date' => today()->toDateString(),
            'device_id' => 1,
            'employee_id' => $employee->id,
        ]);

        return response()->json([
            "message" => "Clocked in successfully at " . now()->hour . ":" . now()->minute,
            "action" => "clock-in",
            "fingerprint_id" => $fingerprintId,
            "name" => $employee->user->name,
        ]);
    }
});


Route::get('sync', function () {
    $action = FingerprintAction::all()->first();
    return response()->json($action);
});

Route::get('queue', function () {
    $jobs = FingerprintAction::all();
    return response()->json($jobs);
});

Route::post('fingerprints/enroll', function (Request $request) {
    $request = $request->all();
    $fingerprint_id = Fingerprint::all()->count() + 1;
    FingerprintAction::create([
        "action" => "add",
        "fingerprint_id" => $fingerprint_id,
        "employee_id" => $request['employee_id'],
        "device_id" => $request['device_id']
    ]);
    return response()->json([
        "message" => "Request to enroll fingerprint sent successfully",
    ]);
});

Route::post('fingerprints/delete', function (Request $request) {
    $request = $request->all();
    if (!Fingerprint::find($request['fingerprint_id'])) return response()->json([
        "message" => "Fingerprint with id: $request[fingerprint_id] not found",
    ]);
    if (FingerprintAction::where('action', 'delete')->where('fingerprint_id', $request['fingerprint_id'])->get()->first()) return response()->json([
        "message" => "Request to delete fingerprint already sent",
    ]);
    FingerprintAction::create([
        "action" => "delete",
        "fingerprint_id" => $request['fingerprint_id'],
    ]);
    return response()->json([
        "message" => "Request to delete fingerprint sent successfully",
    ]);
});

Route::get('test', function () {
    /** @var \PhpMqtt\Client\Contracts\MqttClient $mqtt */
    $mqtt = MQTT::connection();
    // $mqtt->publish('some/topic', 'foo', 1);
    // $mqtt->publish('some/other/topic', 'bar', 2, true); // Retain the message
    // $mqtt->loop(true);

    $mqtt->publish('device/test3', 'foo');
    return response()->json([
        "message" => "Test successful",
    ]);
});
