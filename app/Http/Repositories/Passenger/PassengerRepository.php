<?php

namespace App\Http\Repositories\Passenger;

use Exception;
use App\Models\Ride;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class PassengerRepository
{
    public function createRide(array $data)
    {
        try {
            $passenger = User::where('uid', $data['passenger_uid'])->first();
            $ride = Ride::create([
                'uid'                 => (string) Str::uuid(),
                'passenger_id'        => $passenger->id,
                'driver_id'           => null,
                'pickup_lat'          => $data['pickup_lat'],
                'pickup_lng'          => $data['pickup_lng'],
                'dest_lat'            => $data['dest_lat'],
                'dest_lng'            => $data['dest_lng'],
                'status'              => 'pending',
                'passenger_completed' => false,
                'driver_completed'    => false,
            ]);

            return response()->json([
                'status'  => true,
                'message' => 'Ride created successfully',
            ], 201);

        } catch (Exception $e) {

            Log::error('Ride creation failed', [
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'status'  => false,
                'message' => 'Failed to create ride'
            ], 500);
        }
    }

    public function approveDriver($request)
    {
        try {
            $rideId = $request->ride_uid;
            $driverUid = $request->driver_uid;
            $driver = User::where(['uid' => $driverUid, 'role' => 'driver'])->first();

            if (!$driver) {
                return response()->json([
                    'status'  => false,
                    'message' => 'Driver not found'
                ], 404);
            }

            $ride = Ride::where('uid', $rideId)->first();

            if (!$ride) {
                return response()->json([
                    'status'  => false,
                    'message' => 'Ride not found'
                ], 404);
            }

            if ($ride->status !== 'requested') {
                return response()->json([
                    'status'  => false,
                    'message' => 'Invalid ride status'
                ], 400);
            }

            $ride->update([
                'driver_id' => $driver->id,
                'status' => 'approved'
            ]);

            return response()->json([
                'status'  => true,
                'message' => 'Driver requested approve successfully',
                'data'    => $ride
            ], 200);

        } catch (Exception $e) {

            Log::error('Driver approval failed', [
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'status'  => false,
                'message' => 'Failed to approve driver'
            ], 500);
        }
    }

    public function completeRide($request)
    {
        try {
            $request->validate([
                'ride_uid' => 'required|exists:rides,uid',
            ]);
            
            $rideId = $request->ride_uid;
            $ride = Ride::where('uid', $rideId)->first();

            if (!$ride) {
                return response()->json([
                    'status'  => false,
                    'message' => 'Ride not found'
                ], 404);
            }

            if ($ride->passenger_completed) {
                return response()->json([
                    'status'  => false,
                    'message' => 'Ride already completed by passenger'
                ], 400);
            }

            $ride->update([
                'passenger_completed' => true,
                'status' => 'completed'
            ]);

            return response()->json([
                'status'  => true,
                'message' => 'Ride marked as completed by passenger',
            ], 200);

        } catch (Exception $e) {

            Log::error('Completing ride failed', [
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'status'  => false,
                'message' => 'Failed to complete ride'
            ], 500);
        }
    }
}
