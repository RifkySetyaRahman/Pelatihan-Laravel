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
        'user_id'    => 'required|integer|exists:users,id',
        'room_id'    => 'required|integer',
        'title'      => 'required|string|max:255',
        'start_time' => 'required|date|before:end_time',
        'end_time'   => 'required|date|after:start_time',
    ]);

    $roomId   = $validated['room_id'];
    $newStart = $validated['start_time'];
    $newEnd   = $validated['end_time'];

    // Cek bentrok
    $conflict = Booking::where('room_id', $roomId)
        ->where(function ($query) use ($newStart, $newEnd) {
            $query->whereBetween('start_time', [$newStart, $newEnd]) // Mulai baru di tengah jadwal lama
                ->orWhereBetween('end_time', [$newStart, $newEnd])  // Selesai baru di tengah jadwal lama
                ->orWhere(function ($q) use ($newStart, $newEnd) {   // Jadwal lama berada di dalam jadwal baru
                    $q->where('start_time', '<', $newStart)
                        ->where('end_time', '>', $newEnd);
                });
        })
        ->exists();

    if ($conflict) {
        return back()
            ->withErrors(['error' => 'Ruangan tidak tersedia pada jadwal yang dipilih karena sudah dibooking.'])
            ->withInput();
    }

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
        'room_id'    => 'required|integer',
        'title'      => 'required|string|max:255',
        'start_time' => 'required|date|before:end_time',
        'end_time'   => 'required|date|after:start_time',
    ]);

    $roomId   = $validated['room_id'];
    $newStart = $validated['start_time'];
    $newEnd   = $validated['end_time'];

    // Cek bentrok, tapi abaikan booking yang sedang diedit
    $conflict = Booking::where('room_id', $roomId)
        ->where('id', '!=', $id)
        ->where(function ($query) use ($newStart, $newEnd) {
            $query->whereBetween('start_time', [$newStart, $newEnd]) // mulai baru di tengah jadwal lama
                  ->orWhereBetween('end_time', [$newStart, $newEnd]) // selesai baru di tengah jadwal lama
                  ->orWhere(function ($q) use ($newStart, $newEnd) { // jadwal lama di dalam jadwal baru
                      $q->where('start_time', '<', $newStart)
                        ->where('end_time', '>', $newEnd);
                  });
        })
        ->exists();

    if ($conflict) {
        return back()
            ->withErrors(['error' => 'Ruangan tidak tersedia pada jadwal yang dipilih karena sudah dibooking.'])
            ->withInput();
    }

    $booking = Booking::findOrFail($id);
    $booking->update($validated);

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
// made by Rifky Setya Rahman