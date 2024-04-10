<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Device;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $devices = Device::all()->append('status');
        return response()->json($devices);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Device $device)
    {

        return response()->json($device->append('status'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Device $device)
    {
        $device->update($request->all());
        $device->update([
            'last_online' => now()->timestamp
        ]);
        return response()->json([
            'device' => $device->id
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
