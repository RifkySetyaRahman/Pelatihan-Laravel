@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto p-6">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-semibold text-gray-800">Create New User</h1>
        <a href="{{ route('user.index') }}"
           class="px-4 py-2 border border-blue-600 text-black bg-white rounded hover:bg-blue-100 transition">
           ← Back to User List
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

    <form action="{{ route('user.store') }}" method="POST">
        @csrf

        {{-- Name --}}
        <div class="mb-4 flex items-center gap-4">
            <label for="name" class="w-32 text-gray-700 font-medium">Name</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}"
                   class="w-64 border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300"
                   required>
        </div>
        @error('name')
            <p class="text-red-600 text-sm mb-4 ml-32">{{ $message }}</p>
        @enderror

        {{-- Email --}}
        <div class="mb-4 flex items-center gap-4">
            <label for="email" class="w-32 text-gray-700 font-medium">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}"
                   class="w-64 border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300"
                   required>
        </div>
        @error('email')
            <p class="text-red-600 text-sm mb-4 ml-32">{{ $message }}</p>
        @enderror

        {{-- Role --}}
        <div class="mb-4 flex items-center gap-4">
            <label for="role" class="w-32 text-gray-700 font-medium">Role</label>
            <select name="role" id="role"
                    class="w-64 border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300"
                    required>
                <option value="user" {{ old('role') === 'user' ? 'selected' : '' }}>User</option>
                <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Admin</option>
            </select>
        </div>
        @error('role')
            <p class="text-red-600 text-sm mb-4 ml-32">{{ $message }}</p>
        @enderror

        {{-- Password --}}
        <div class="mb-4 flex items-center gap-4">
            <label for="password" class="w-32 text-gray-700 font-medium">Password</label>
            <input type="password" name="password" id="password"
                   class="w-64 border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300"
                   required>
        </div>
        @error('password')
            <p class="text-red-600 text-sm mb-4 ml-32">{{ $message }}</p>
        @enderror

        {{-- Confirm Password --}}
        <div class="mb-4 flex items-center gap-4">
            <label for="password_confirmation" class="w-32 text-gray-700 font-medium">Confirm</label>
            <input type="password" name="password_confirmation" id="password_confirmation"
                   class="w-64 border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300"
                   required>
        </div>

        {{-- Submit --}}
            <div class="text-right pt-4">
            <button type="submit" class="btn btn-success">Add User</button>
        </div>
    </form>
</div>
@endsection
