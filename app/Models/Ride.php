<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ride extends Model
{
    protected $fillable = [
        'uid',
        'passenger_id',
        'driver_id',
        'pickup_lat',
        'pickup_lng',
        'dest_lat',
        'dest_lng',
        'status',
        'passenger_completed',
        'driver_completed',
    ];

    public function passenger()
    {
        return $this->belongsTo(User::class, 'passenger_id');
    }

    public function driver()
    {
        return $this->belongsTo(User::class, 'driver_id');
    }
}
