<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    // Display all rooms
    public function index()
    {
        $rooms = Room::all();
        return inertia('Rooms/Index', compact('rooms'));
    }

    // Show create form
    public function create()
    {
        return inertia('Rooms/Create');
    }

    // Store a new room
    public function store(Request $request)
    {
        $validated = $request->validate([
            'room_number' => 'required|string|unique:rooms,room_number',
            'floor' => 'required|integer',
            'capacity' => 'required|integer',
            'price' => 'required|numeric',
            'facilities' => 'nullable|array',
            'description' => 'nullable|string',
        ]);

        Room::create($validated);

        return redirect()->route('rooms.index')->with('success', 'Room created successfully.');
    }

    // Show edit form
    public function edit(Room $room)
    {
        return inertia('Rooms/Edit', compact('room'));
    }

    // Update a room
    public function update(Request $request, Room $room)
    {
        $validated = $request->validate([
            'room_number' => 'required|string|unique:rooms,room_number,' . $room->id,
            'floor' => 'required|integer',
            'capacity' => 'required|integer',
            'price' => 'required|numeric',
            'facilities' => 'nullable|array',
            'description' => 'nullable|string',
        ]);

        $room->update($validated);

        return redirect()->route('rooms.index')->with('success', 'Room updated successfully.');
    }

    // Delete a room
    public function destroy(Room $room)
    {
        $room->delete();

        return redirect()->route('rooms.index')->with('success', 'Room deleted successfully.');
    }
}
