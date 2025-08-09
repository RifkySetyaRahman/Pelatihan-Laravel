@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Edit Room</h2>

    <form action="{{ route('room.update', $room['id']) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Room Name --}}
        <div class="mb-3">
            <label for="name" class="form-label">Room Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $room['name'] }}" required>
        </div>

        {{-- Capacity --}}
        <div class="mb-3">
            <label for="capacity" class="form-label">Capacity</label>
            <input type="number" name="capacity" id="capacity" class="form-control" value="{{ $room['capacity'] }}" required>
        </div>

        {{-- Facilities --}}
        <div class="mb-3">
            <label for="facilities" class="form-label">Facilities</label>
            <input type="text" name="facilities" id="facilities" class="form-control" value="{{ $room['facilities'] }}">
        </div>

        {{-- Buttons --}}
        <div class="d-flex">
            <button type="submit" class="btn btn-success me-2">
                <i class="bi bi-save"></i> Update Room
            </button>
            <a href="{{ route('room.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Cancel
            </a>
        </div>
    </form>
</div>
@endsection
{{-- made by Rifky Setya Rahman --}}