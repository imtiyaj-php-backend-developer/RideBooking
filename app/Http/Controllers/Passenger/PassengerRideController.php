<?php

namespace App\Http\Controllers\Passenger;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Passenger\PassengerRequest;
use App\Http\Repositories\Passenger\PassengerRepository;
use App\Http\Requests\Passenger\RideActionRequest;

class PassengerRideController extends Controller
{
    public function createRide(PassengerRequest $request, PassengerRepository $repository)
    {
       return  $repository->createRide($request->validated());
    }

    public function approveDriver(PassengerRepository $repository, RideActionRequest $request)
    {
        return $repository->approveDriver($request);
    }

    public function completeRide(PassengerRepository $repository, Request $request)
    {
        return $repository->completeRide($request);
    }
}
