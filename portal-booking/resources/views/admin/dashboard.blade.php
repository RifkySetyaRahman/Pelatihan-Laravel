@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Admin Dashboard
    </h2>
@endsection

@section('content')
<div class="container py-4">
    <h1 class="mb-4">Admin Dashboard</h1>

    <div class="row">
        <!-- User Management -->
        <div class="col-md-4">
            <div class="card mb-4 border-primary">
                <div class="card-body">
                    <h4 class="card-title">User Management</h4>
                    <p class="card-text">Manage application users</p>
                    <a href="{{ url('admin/user') }}" class="btn btn-primary">View Users</a>
                    <a href="{{ url('admin/user/create') }}" class="btn btn-success">Add New User</a>
                </div>
            </div>
        </div>

        <!-- Booking Management -->
        <div class="col-md-4">
            <div class="card mb-4 border-success">
                <div class="card-body">
                    <h4 class="card-title">Booking Management</h4>
                    <p class="card-text">Manage room bookings</p>
                    <a href="{{ url('admin/booking') }}" class="btn btn-primary">View Bookings</a>
                    <a href="{{ url('admin/booking/create') }}" class="btn btn-success">Add New Booking</a>
                </div>
            </div>
        </div>

        <!-- Room Management -->
        <div class="col-md-4">
            <div class="card mb-4 border-warning">
                <div class="card-body">
                    <h4 class="card-title">Room Management</h4>
                    <p class="card-text">Manage available rooms</p>
                    <a href="{{ url('admin/room') }}" class="btn btn-primary">View Rooms</a>
                    <a href="{{ url('admin/room/create') }}" class="btn btn-success">Add New Room</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
{{-- made by Rifky Setya Rahman --}}