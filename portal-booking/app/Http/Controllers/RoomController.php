<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RoomController extends Controller
{
    protected $apiUrl = 'http://room-service-nginx/api/rooms';

    protected function withAuth()
    {
        return Http::withToken(config('services.room_service.token'));
    }

    public function index()
    {
        $response = $this->withAuth()->get($this->apiUrl);
        $rooms = $response->json();

        return view('room.index', compact('rooms'));
    }

    public function create()
    {
        return view('room.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'capacity' => 'required|integer',
            'facilities' => 'nullable|string',
        ]);

        $this->withAuth()->post($this->apiUrl, $validated);

        return redirect()->route('room.index')->with('success', 'Room created successfully.');
    }

    public function show($id)
    {
        $response = $this->withAuth()->get("{$this->apiUrl}/{$id}");
        $room = $response->json();

        return view('room.show', compact('room'));
    }

    public function edit($id)
    {
        $response = $this->withAuth()->get("{$this->apiUrl}/{$id}");
        $room = $response->json();

        return view('room.edit', compact('room'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
        ]);

        $this->withAuth()->put("{$this->apiUrl}/{$id}", $validated);

        return redirect()->route('room.index')->with('success', 'Room updated successfully.');
    }

    public function destroy($id)
    {
        $this->withAuth()->delete("{$this->apiUrl}/{$id}");

        return redirect()->route('room.index')->with('success', 'Room deleted successfully.');
    }
}
// made by Rifky Setya Rahman