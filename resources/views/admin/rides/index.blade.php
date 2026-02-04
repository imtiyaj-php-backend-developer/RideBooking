@extends('admin.layouts.app')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-white">
        <h4 class="mb-0">All Rides</h4>
    </div>

    <div class="card-body">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Passenger</th>
                    <th>Driver</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th width="120">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($rides as $ride)
                    <tr>
                        <td>{{ $ride->id }}</td>
                        <td>{{ $ride->passenger->name ?? 'N/A' }}</td>
                        <td>{{ $ride->driver->name ?? 'Not Assigned' }}</td>
                        <td>
                            <span class="badge bg-info text-dark">
                                {{ ucfirst($ride->status) }}
                            </span>
                        </td>
                        <td>{{ $ride->created_at->format('d M Y, h:i A') }}</td>
                        <td>
                            <a href="{{ url('/admin/rides/'.$ride->id) }}" class="btn btn-sm btn-primary">
                                View
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No rides found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
