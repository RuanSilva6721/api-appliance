<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Brand>
 */
class BrandFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => Arr::random([
                "Samsung",
                "LG",
                "Sony",
                "Panasonic",
                "Philips",
                "Electrolux",
                "Whirlpool",
                "Bosch",
                "Miele",
                "Haier",
              ]),
            'icon' => Arr::random([
                "live_tv",
                "movie",
                "sports_soccer",
                "music_note",
                "camera",
                "brush",
                "restaurant",
                "shopping_cart",
                "directions_bike",
                "school",
              ]),
        ];
    }
}
