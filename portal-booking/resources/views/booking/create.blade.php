@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto p-6">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-semibold text-gray-800">Create Booking</h1>
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

    {{-- Booking Form --}}
    <form action="{{ route('booking.store') }}" method="POST">
        @csrf

        {{-- User --}}
        <div class="mb-4 flex items-center gap-4">
            <label for="user_id" class="w-32 text-gray-700 font-medium">User</label>
            <select name="user_id" id="user_id"
                    class="w-64 border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300"
                    required>
                <option value="">-- Select User --</option>
                @forelse ($users as $u)
                    <option value="{{ $u->id }}" {{ old('user_id') == $u->id ? 'selected' : '' }}>
                        {{ $u->name }} (ID: {{ $u->id }})
                    </option>
                @empty
                    <option disabled>No users found</option>
                @endforelse
            </select>
        </div>

        {{-- Room --}}
            <div class="mb-4 flex items-center gap-4">
            <label for="room_id" class="w-32 text-gray-700 font-medium">Room</label>
            <select name="room_id" id="room_id"
                    class="w-64 border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300"
                    required>
            <option value="">-- Select Room --</option>
            @foreach($rooms as $room)
            <option value="{{ $room['id'] }}"
                    data-capacity="{{ $room['capacity'] }}"
                    data-facilities="{{ $room['facilities'] }}">
                {{ $room['name'] }} (Kapasitas: {{ $room['capacity'] }})
            </option>
            @endforeach
            </select>

    {{-- Room details --}}
        <div id="room-details" class="mt-3 text-sm text-gray-700">
            <p><strong>Kapasitas:</strong> <span id="room-capacity">-</span></p>
            <p><strong>Fasilitas:</strong> <span id="room-facilities">-</span></p>
            </div>
        </div>

        {{-- Title --}}
        <div class="mb-4 flex items-center gap-4">
            <label for="title" class="w-32 text-gray-700 font-medium">Title</label>
            <input type="text" name="title" id="title" value="{{ old('title') }}"
                   class="w-64 border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300"
                   required>
        </div>

        {{-- Start Time --}}
        <div class="mb-4 flex items-center gap-4">
            <label for="start_time" class="w-32 text-gray-700 font-medium">Start Time</label>
            <input type="datetime-local" name="start_time" id="start_time" value="{{ old('start_time') }}"
                   class="w-64 border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300"
                   required>
        </div>

        {{-- End Time --}}
        <div class="mb-4 flex items-center gap-4">
            <label for="end_time" class="w-32 text-gray-700 font-medium">End Time</label>
            <input type="datetime-local" name="end_time" id="end_time" value="{{ old('end_time') }}"
                   class="w-64 border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300"
                   required>
        </div>

        {{-- Submit --}}
        <div class="text-right pt-4">
            <button type="submit" class="btn btn-success">Add Booking</button>
        </div>
    </form>
</div>

<script>
document.getElementById('room_id').addEventListener('change', function () {
    let selected = this.options[this.selectedIndex];
    document.getElementById('room-capacity').textContent = selected.dataset.capacity || '-';
    document.getElementById('room-facilities').textContent = selected.dataset.facilities || '-';
});
</script>
@endsection

{{-- made by Rifky Setya Rahman --}}