@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Booking List</h2>
    <a href="{{ route('booking.create') }}" class="btn btn-primary mb-3">Add New Booking</a>
    <a href="{{ route('admin.dashboard') }}" class="btn btn-primary mb-3">Kembali Ke Dashboard</a>


    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Title</th>
                <th>User</th>
                <th>Room ID</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bookings as $b)
                <tr>
                    <td>{{ $b->title }}</td>
                    <td>{{ $b->user->name }}</td>
                    <td>{{ $b->room_id }}</td>
                    <td>{{ $b->start_time }}</td>
                    <td>{{ $b->end_time }}</td>
                    <td>
                        <a href="{{ route('booking.edit', $b->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('booking.destroy', $b->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this booking?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>


@endsection
{{-- made by Rifky Setya Rahman --}}