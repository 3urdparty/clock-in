<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Jobs\RemoveFingerprint;
use App\Models\Employee;
use App\Models\Fingerprint;
use App\Models\FingerprintAction;
use Illuminate\Http\Request;

class FingerprintController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Employee $employee)
    {
        if ($employee->exists) {
            $fingerprints = $employee->fingerprints;
        } else {
            $fingerprints = Fingerprint::all();
        }
        return response()->json($fingerprints);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fingerprint_id = $request->input('fingerprint_id');
        $action = FingerprintAction::where('action', 'add')->where('fingerprint_id', $fingerprint_id)->get()->first();

        if (!$action) return response()->json([
            "message" => "No action found for fingerprint_id: $fingerprint_id",
        ]);


        $fingerprint = Fingerprint::create([
            'id' => $fingerprint_id,
            'employee_id' => $action->employee_id,
            'device_id' => $action->device_id,
        ]);
        $action->delete();
        return response()->json([
            "message" => "Fingerprint with id: $fingerprint_id has been enrolled successfully",
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $fingerprint = Fingerprint::findOrFail($id);
        return response()->json($fingerprint);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Fingerprint $fingerprint)
    {
        $action = FingerprintAction::where('action', 'delete')->where('fingerprint_id', $fingerprint->id)->get()->first();
        if (!$fingerprint) return response()->json([
            "message" => "Fingerprint with id: $request[fingerprint_id] not found",
        ]);
        $fingerprint->delete();
        $action->delete();
        return response()->json([
            "message" => "Fingerprint with ID:$fingerprint->id has been deleted successfully",
        ]);
    }
}
