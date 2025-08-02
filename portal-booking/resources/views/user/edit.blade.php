@extends('layouts.app')

@section('content')
<h2>Edit User</h2>

<form action="{{ route('user.update', $user->id) }}" method="POST">
    @csrf @method('PUT')
    <div class="mb-3">
        <label class="form-label">Name</label>
        <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection
