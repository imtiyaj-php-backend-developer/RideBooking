<?php

namespace App\Http\Repositories\Driver;

use App\Models\Ride;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Log;

class DriverRepository
{
    public function updateLocation($data)
    {
        try {
            $driver = User::where('uid', $data['driver_uid'])
                ->where('role', 'driver')
                ->first();

            if (!$driver) {
                return response()->json([
                    'status' => false,
                    'message' => 'Driver not found'
                ], 404);
            }

            $driver->update([
                'latitude'  => $data['latitude'],
                'longitude' => $data['longitude'],
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Location updated successfully',
                'data' => $driver
            ]);

        } catch (Exception $e) {
            Log::error('Update location failed', ['error' => $e->getMessage()]);

            return response()->json([
                'status' => false,
                'message' => 'Failed to update location'
            ], 500);
        }
    }

    public function nearbyRides($driverUid)
    {
        try {
            $driver = User::where('uid', $driverUid)
                ->where('role', 'driver')
                ->first();

            if (!$driver) {
                return response()->json([
                    'status' => false,
                    'message' => 'Driver not found'
                ], 404);
            }

            $rides = Ride::where('status', 'pending')
                ->whereNull('driver_id')
                ->get()
                ->filter(function ($ride) use ($driver) {
                    return abs($ride->pickup_lat - $driver->latitude) < 0.1 &&
                           abs($ride->pickup_lng - $driver->longitude) < 0.1;
                })
                ->values();

            return response()->json([
                'status' => true,
                'message' => 'Nearby rides fetched successfully',
                'data' => $rides
            ]);

        } catch (Exception $e) {
            Log::error('Nearby rides failed', ['error' => $e->getMessage()]);

            return response()->json([
                'status' => false,
                'message' => 'Failed to fetch nearby rides'
            ], 500);
        }
    }

    public function requestRide($request)
    {
        try {

            $driverUid = $request->driver_uid;
            $rideId = $request->ride_uid;

            $driver = User::where('uid', $driverUid)
                ->where('role', 'driver')
                ->first();

            if (!$driver) {
                return response()->json([
                    'status' => false,
                    'message' => 'Driver not found'
                ], 404);
            }

            $ride = Ride::where('uid', $rideId)
                ->where('status', 'pending')
                ->whereNull('driver_id')
                ->first();

            if (!$ride) {
                return response()->json([
                    'status' => false,
                    'message' => 'Ride not available'
                ], 404);
            }

            $ride->update([
                'driver_id' => $driver->id,
                'status' => 'requested'
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Ride requested successfully',
                'data' => $ride
            ]);

        } catch (Exception $e) {
            Log::error('Request ride failed', ['error' => $e->getMessage()]);

            return response()->json([
                'status' => false,
                'message' => 'Failed to request ride'
            ], 500);
        }
    }

    public function completeRide($request)
    {
        try {
            $driverUid = $request->driver_uid;
            $rideId = $request->ride_uid;

            $driver = User::where('uid', $driverUid)
                ->where('role', 'driver')
                ->first();

            if (!$driver) {
                return response()->json([
                    'status' => false,
                    'message' => 'Driver not found'
                ], 404);
            }

            $ride = Ride::where('uid', $rideId)
                ->where('driver_id', $driver->id)
                ->first();

            if (!$ride) {
                return response()->json([
                    'status' => false,
                    'message' => 'Ride not found or not assigned to driver'
                ], 404);
            }

            if ($ride->driver_completed) {
                return response()->json([
                    'status' => false,
                    'message' => 'Ride already completed'
                ], 400);
            }

            $ride->driver_completed = true;

            if ($ride->passenger_completed) {
                $ride->status = 'completed';
            }

            $ride->save();

            return response()->json([
                'status' => true,
                'message' => 'Ride completed successfully by driver!',
            ]);

        } catch (Exception $e) {
            Log::error('Complete ride failed', ['error' => $e->getMessage()]);

            return response()->json([
                'status' => false,
                'message' => 'Failed to complete ride'
            ], 500);
        }
    }
}
