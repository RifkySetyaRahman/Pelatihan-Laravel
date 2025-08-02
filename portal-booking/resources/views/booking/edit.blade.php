@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Booking</h2>

    <form action="{{ route('booking.update', $booking->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Room</label>
            <select name="room_id" class="form-control" required>
                <option value="">-- Select Room --</option>
                @foreach ($rooms as $room)
                    <option value="{{ $room['id'] }}" {{ $room['id'] == $booking->room_id ? 'selected' : '' }}>
                        {{ $room['name'] }} (ID: {{ $room['id'] }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" value="{{ $booking->title }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Start Time</label>
            <input type="datetime-local" name="start_time" class="form-control" 
                   value="{{ \Carbon\Carbon::parse($booking->start_time)->format('Y-m-d\TH:i') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">End Time</label>
            <input type="datetime-local" name="end_time" class="form-control" 
                   value="{{ \Carbon\Carbon::parse($booking->end_time)->format('Y-m-d\TH:i') }}" required>
        </div>

        <button type="submit" class="btn btn-success">Update Booking</button>
    </form>
</div>
@endsection
