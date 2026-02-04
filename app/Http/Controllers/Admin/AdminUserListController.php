<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Admin\AdminUserListRepository;

class AdminUserListController extends Controller
{
    protected AdminUserListRepository $repository;

    public function __construct(AdminUserListRepository $repository)
    {
        $this->repository = $repository;
    }

    public function passengers()
    {
        return $this->repository->passengerList();
    }

    public function drivers()
    {
        return $this->repository->driverList();
    }
}
