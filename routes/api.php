<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Driver\DriverController;
use App\Http\Controllers\Passenger\PassengerRideController;
use App\Http\Controllers\Admin\AdminUserListController;

// Passenger Ride Routes
Route::prefix('passenger')->group(function () {
    Route::post('ride', [PassengerRideController::class, 'createRide']);
    Route::patch('ride/approve', [PassengerRideController::class, 'approveDriver']);
    Route::patch('ride/complete', [PassengerRideController::class, 'completeRide']);
});

// Driver Ride Routes
Route::prefix('driver')->group(function () {
    Route::put('location', [DriverController::class, 'updateLocation']);
    Route::get('rides/nearby', [DriverController::class, 'nearbyRides']);
    Route::patch('ride/request', [DriverController::class, 'requestRide']);
    Route::patch('ride/complete', [DriverController::class, 'completeRide']);
});

// Admin Ride Routes
Route::prefix('admin')->group(function () {
    Route::get('passengers', [AdminUserListController::class, 'passengers']);
    Route::get('drivers', [AdminUserListController::class, 'drivers']);
});

