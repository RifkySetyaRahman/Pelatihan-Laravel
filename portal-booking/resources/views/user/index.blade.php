@extends('layouts.app')

@section('content')
<h2>User List</h2>
<a href="{{ route('user.create') }}" class="btn btn-success mb-3">Add New User</a>
<a href="{{ route('admin.dashboard') }}" class="btn btn-primary mb-3">Kembali Ke Dashboard</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Name</th><th>Email</th><th>Role</th><th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $u)
        <tr>
            <td>{{ $u->name }}</td>
            <td>{{ $u->email }}</td>
            <td>{{ $u->role }}</td>
            <td>
                <a href="{{ route('user.edit', $u->id) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('user.destroy', $u->id) }}" method="POST" style="display:inline;">
                    @csrf @method('DELETE')
                    <button onclick="return confirm('Delete this user?')" class="btn btn-sm btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
