@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto p-6">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-semibold text-gray-800">Add New Room</h1>
        <a href="{{ route('room.index') }}"
           class="px-4 py-2 border border-blue-600 text-black bg-white rounded hover:bg-blue-100 transition">
           ← Back to Room List
        </a>
    </div>

    @if ($errors->any())
        <div class="mb-4 text-red-600">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('room.store') }}" method="POST">
        @csrf

        {{-- Room Name --}}
        <div class="mb-4 flex items-center gap-4">
            <label for="name" class="w-32 text-gray-700 font-medium">Room Name</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}"
                   class="w-64 border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300"
                   required>
        </div>
        @error('name')
            <p class="text-red-600 text-sm mb-4 ml-32">{{ $message }}</p>
        @enderror

        {{-- Capacity --}}
        <div class="mb-4 flex items-center gap-4">
            <label for="capacity" class="w-32 text-gray-700 font-medium">Capacity</label>
            <input type="number" name="capacity" id="capacity" value="{{ old('capacity') }}"
                   class="w-64 border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300"
                   required>
        </div>
        @error('capacity')
            <p class="text-red-600 text-sm mb-4 ml-32">{{ $message }}</p>
        @enderror

        {{-- Facilities --}}
        <div class="mb-4 flex items-center gap-4">
            <label for="facilities" class="w-32 text-gray-700 font-medium">Facilities</label>
            <input type="text" name="facilities" id="facilities" value="{{ old('facilities') }}"
       placeholder="Contoh: Proyektor, AC, Whiteboard"
       class="w-64 border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300">

        </div>
        @error('facilities')
            <p class="text-red-600 text-sm mb-4 ml-32">{{ $message }}</p>
        @enderror

        {{-- Submit --}}
        <div class="text-right pt-4">
            <button type="submit" class="btn btn-success">Add Room</button>
        </div>
    </form>
</div>
@endsection
{{-- made by Rifky Setya Rahman --}}