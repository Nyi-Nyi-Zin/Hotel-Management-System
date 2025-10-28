<?php

namespace Database\Factories;

use App\Models\Room;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Room>
 */
class RoomFactory extends Factory
{

       protected $model = Room::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
      return [
            'room_number' => $this->faker->unique()->numberBetween(100, 999),
            'floor' => $this->faker->numberBetween(1, 10),
            'capacity' => $this->faker->numberBetween(1, 6),
            'price' => $this->faker->randomFloat(2, 50, 500),
            'facilities' => $this->faker->randomElements(['WiFi','AC','TV','Mini-bar'], 2),
            'description' => $this->faker->sentence(),
        ];
    }
}
