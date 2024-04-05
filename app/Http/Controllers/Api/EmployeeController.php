<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\User;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::with(['user', 'recentShift'])->get()->append(['status']);
        return response()->json($employees);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $values = $request->validate([
            "name" => "required|string",
            "email" => "required|email|unique:users,email" . auth()->id(),
            "password" => "required|string",
            "phone_number" => "required|string",
            "username" => "required|string",
            "image_url" => "nullable|string",
            "role" => "required|string",
            "description" => "nullable|string",
        ]);
        $user = User::create($values);
        $employee = Employee::make($values);
        $employee->user()->associate($user);
        $employee->save();
        return response()->json($employee);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)

    {
        $employee = Employee::with(['user', 'fingerprints', 'shifts'])->find($id);
        return response()->json($employee);
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
    public function destroy(string $id)
    {
        //
    }
}
