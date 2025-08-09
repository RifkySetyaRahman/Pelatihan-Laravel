@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Room List</h2>

    <a href="{{ route('room.create') }}" class="btn btn-success mb-3">Add New Room</a>
    <a href="{{ route('admin.dashboard') }}" class="btn btn-primary mb-3">Back to Dashboard</a>

    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>Name</th>
                <th>Capacity</th>
                <th>Facilities</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($rooms as $room)
            <tr>
                <td>{{ $room['name'] }}</td>
                <td>{{ $room['capacity'] }}</td>
                <td>{{ $room['facilities'] }}</td>
                <td>
                    <a href="{{ route('room.edit', $room['id']) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('room.destroy', $room['id']) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Delete this room?')" class="btn btn-sm btn-danger">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center text-muted">No rooms found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
{{-- made by Rifky Setya Rahman --}}