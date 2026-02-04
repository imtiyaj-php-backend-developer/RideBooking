<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Driver\DriverRepository;
use Illuminate\Http\Request;
use App\Http\Requests\Driver\UpdateLocationRequest;
use App\Http\Requests\Driver\NearbyRidesRequest;
use App\Http\Requests\Driver\RideActionRequest;
use App\Models\Ride;

class DriverController extends Controller
{
    public function updateLocation(DriverRepository $repository, UpdateLocationRequest $request)
    {
        return $repository->updateLocation($request);
    }

    public function nearbyRides(DriverRepository $repository, NearbyRidesRequest $request)
    {
        return $repository->nearbyRides($request->driver_uid);
    }

    public function requestRide(DriverRepository $repository, RideActionRequest $request)
    {
        return $repository->requestRide($request);
    }

    public function completeRide(DriverRepository $repository, RideActionRequest $request)
    {
        return $repository->completeRide($request);
    }
}
