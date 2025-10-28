<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::all();
        return Inertia::render('Rooms/Index', ['rooms' => $rooms]);
    }

    // we can remove create() and edit() methods entirely
    // modal will handle both

    public function store(Request $request)
    {
        Room::create([
            'room_number' => $request->room_number,
            'floor' => $request->floor,
            'capacity' => $request->capacity,
            'price' => $request->price,
            'facilities' => $request->facilities,
            'description' => $request->description,
        ]);

        // Return updated rooms list to Index
        return redirect()->back();
    }

    public function update(Request $request, Room $room)
    {
        $room->update([
            'room_number' => $request->room_number,
            'floor' => $request->floor,
            'capacity' => $request->capacity,
            'price' => $request->price,
            'facilities' => $request->facilities,
            'description' => $request->description,
        ]);

        return redirect()->back();
    }

    public function destroy(Room $room)
    {
        $room->delete();
        return redirect()->back();
    }
}
