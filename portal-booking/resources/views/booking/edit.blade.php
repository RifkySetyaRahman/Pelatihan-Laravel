@extends('layouts.app')

@section('content')
<div class="container">
    <div class="max-w-2xl mx-auto p-6">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-semibold text-gray-800">Edit Booking</h1>
        <a href="{{ route('booking.index') }}"
           class="px-4 py-2 border border-blue-600 text-black bg-white rounded hover:bg-blue-100 transition">
           ← Back to Booking List
        </a>
    </div>

    {{-- Error Validation --}}
    @if ($errors->any())
        <div class="mb-4 text-red-600">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <form action="{{ route('booking.update', $booking->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Room</label>
            <select name="room_id" class="form-control" required>
                <option value="">-- Select Room --</option>
                @foreach ($rooms as $room)
                    <option value="{{ $room['id'] }}" {{ $room['id'] == $booking->room_id ? 'selected' : '' }}>
                        {{ $room['name'] }} (ID: {{ $room['id'] }}) (Kapasitas: {{ $room['capacity'] }})
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
{{-- made by Rifky Setya Rahman --}}