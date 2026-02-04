@extends('admin.layouts.app')

@section('content')

<a href="{{ url('/admin/rides') }}" class="btn btn-secondary mb-3">
    ← Back to Rides
</a>

<div class="card shadow-sm">
    <div class="card-header bg-white">
        <h4>Ride Details (#{{ $ride->id }})</h4>
    </div>

    <div class="card-body">
        <div class="row mb-3">
            <div class="col-md-6">
                <h6>Passenger</h6>
                <p>{{ $ride->passenger->name ?? 'N/A' }}</p>
            </div>

            <div class="col-md-6">
                <h6>Driver</h6>
                <p>{{ $ride->driver->name ?? 'Not Assigned' }}</p>
            </div>
        </div>

        <hr>

        <div class="row mb-3">
            <div class="col-md-6">
                <h6>Pickup Location</h6>
                <p>
                    Lat: {{ $ride->pickup_lat }} <br>
                    Lng: {{ $ride->pickup_lng }}
                </p>
            </div>

            <div class="col-md-6">
                <h6>Destination</h6>
                <p>
                    Lat: {{ $ride->dest_lat }} <br>
                    Lng: {{ $ride->dest_lng }}
                </p>
            </div>
        </div>

        <hr>

        <div class="row">
            <div class="col-md-4">
                <h6>Status</h6>
                <span class="badge bg-success">
                    {{ ucfirst($ride->status) }}
                </span>
            </div>

            <div class="col-md-4">
                <h6>Created At</h6>
                <p>{{ $ride->created_at->format('d M Y, h:i A') }}</p>
            </div>

            <div class="col-md-4">
                <h6>Updated At</h6>
                <p>{{ $ride->updated_at->format('d M Y, h:i A') }}</p>
            </div>
        </div>
    </div>
</div>

@endsection
