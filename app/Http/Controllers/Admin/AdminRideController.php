<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Admin\AdminRideRepository;

class AdminRideController extends Controller
{
    protected AdminRideRepository $repository;

    public function __construct(AdminRideRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $rides = $this->repository->getAllRides();
        return view('admin.rides.index', compact('rides'));
    }

    public function show($id)
    {
        $ride = $this->repository->getRideById($id);
        return view('admin.rides.show', compact('ride'));
    }
}
