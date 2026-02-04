<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminRideController;

Route::get('/', function () {
    return view('welcome');
});

// Admin Ride Routes
Route::get('/admin/rides', [AdminRideController::class, 'index']);
Route::get('/admin/rides/{id}', [AdminRideController::class, 'show']);
