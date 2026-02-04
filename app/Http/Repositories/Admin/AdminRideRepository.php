<?php

namespace App\Http\Repositories\Admin;

use App\Models\Ride;
use Exception;

class AdminRideRepository
{
    public function getAllRides()
    {
        try {
            return Ride::with(['passenger', 'driver'])
                ->latest()
                ->get();
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getRideById($id)
    {
        try {
            return Ride::with(['passenger', 'driver'])
                ->findOrFail($id);
        } catch (Exception $e) {
            throw $e;
        }
    }
}
