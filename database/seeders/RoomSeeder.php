<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Room;

class RoomSeeder extends Seeder
{
    public function run(): void
    {
        // Example rooms
        $rooms = [
            [
                'room_number' => '101',
                'floor' => 1,
                'type' => 'Standard',
                'capacity' => 2,
                'price' => 50.00,
                'facilities' => ['WiFi', 'Air Conditioning', 'TV'],
                'description' => 'Cozy room with two beds and all basic facilities.',
            ],
            [
                'room_number' => '102',
                'floor' => 1,
                'type' => 'Deluxe',
                'capacity' => 3,
                'price' => 75.00,
                'facilities' => ['WiFi', 'Air Conditioning', 'TV', 'Mini Fridge'],
                'description' => 'Spacious room suitable for a small family.',
            ],
            [
                'room_number' => '201',
                'floor' => 2,
                'type' => 'Deluxe',
                'capacity' => 1,
                'price' => 40.00,
                'facilities' => ['WiFi', 'TV'],
                'description' => 'Single room for solo travelers.',
            ],
        ];

        foreach ($rooms as $room) {
            Room::create($room);
        }
    }
}
