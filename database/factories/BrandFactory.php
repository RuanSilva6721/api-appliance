<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
            'name' => $this->faker->randomElement([
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
            'description' => $this->faker->sentence,
            'icon' => $this->faker->randomElement([
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
