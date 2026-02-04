<?php

namespace App\Http\Repositories\Admin;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Log;

class AdminUserListRepository
{
    public function passengerList()
    {
        try {
            $passengers = User::where('role', 'passenger')
                ->select('id', 'uid', 'name', 'latitude', 'longitude', 'created_at')
                ->latest()
                ->get();

            return response()->json([
                'status' => true,
                'message' => 'Passenger list fetched successfully',
                'data' => $passengers
            ]);

        } catch (Exception $e) {
            Log::error('Admin passenger list failed', [
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'status' => false,
                'message' => 'Failed to fetch passengers'
            ], 500);
        }
    }

    public function driverList()
    {
        try {
            $drivers = User::where('role', 'driver')
                ->select('id', 'uid', 'name', 'latitude', 'longitude', 'created_at')
                ->latest()
                ->get();

            return response()->json([
                'status' => true,
                'message' => 'Driver list fetched successfully',
                'data' => $drivers
            ]);

        } catch (Exception $e) {
            Log::error('Admin driver list failed', [
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'status' => false,
                'message' => 'Failed to fetch drivers'
            ], 500);
        }
    }
}
