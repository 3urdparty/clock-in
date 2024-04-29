<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\User;
use App\Http\Requests\StoreEmployeeRequest;
use Database\Factories\EmployeeFactory;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::with(['user'])->get()->append(['status']);

        return response()->json($employees);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $values = $request->input('values');

        $values['password'] = bcrypt($values['password']);
        $values['image_url'] =   fake()->randomElement(EmployeeFactory::faces);
        $user = User::create($values);
        $employee = Employee::make($values);
        $employee->user()->associate($user);
        $employee->save();
        return response()->json($user);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)

    {
        $employee = Employee::with(['user', 'fingerprints', 'shifts.employee'])->find($id)->append(['status']);
        return response()->json($employee);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {

        $values = $request->input('values');
        data_forget($values, 'id');
        data_forget($values, 'user');
        data_forget($values, 'created_at');
        data_forget($values, 'recent_shift');
        data_forget($values, 'updated_at');
        data_forget($values, 'user_id');
        data_forget($values, 'status');

        $employee->update($values);
        $employee->user->update($values);

        return response()->json($values);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {

        $employee->user->delete();
        return response()->json([]);
    }
}
