<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Room;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class BookingController extends Controller
{
    /**
     * Display a listing of bookings.
     */
    public function index()
{
    $bookings = Booking::all();
    return view('booking.index', compact('bookings'));
}

    /**
     * Show the form for creating a new booking.
     */
    public function create()
{
    $response = Http::withToken(config('services.room_service.token'))
                ->get('http://room-service-nginx/api/rooms');
    $rooms = $response->successful() ? $response->json() : [];

    $users = User::all();

    return view('booking.create', compact('users', 'rooms'));
}


    /**
     * Store a newly created booking in storage.
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'user_id' => 'required|integer|exists:users,id',
            'room_id' => 'required|integer',
            'title' => 'required|string|max:255',
            'start_time' => 'required|date|before:end_time',
            'end_time' => 'required|date|after:start_time',
        ]);

        Booking::create($validated);

        return redirect()->route('booking.index')->with('success', 'Booking created successfully!');
    }

    /**
     * Display the specified booking.
     */
    public function show($id)
    {
        $bookings = Booking::findOrFail($id);
        return view('booking.show', compact('bookings'));
    }

    /**
     * Show the form for editing the specified booking.
     */
    public function edit($id)
{
    $booking = Booking::findOrFail($id);

    $response = Http::withToken(config('services.room_service.token'))
                    ->get('http://room-service-nginx/api/rooms');

    $rooms = $response->successful() ? $response->json() : [];

    return view('booking.edit', compact('booking', 'rooms'));
}



    /**
     * Update the specified booking in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'room_id' => 'required|integer',
            'title' => 'required|string|max:255',
            'start_time' => 'required|date|before:end_time',
            'end_time' => 'required|date|after:start_time',
        ]);

        $bookings = Booking::findOrFail($id);
        $bookings->update($validated);

        return redirect()->route('booking.index')->with('success', 'Booking updated successfully!');
    }

    /**
     * Remove the specified booking from storage.
     */
    public function destroy($id)
    {
        $bookings = Booking::findOrFail($id);
        $bookings->delete();

        return redirect()->route('booking.index')->with('success', 'Booking deleted successfully!');
    }
}
