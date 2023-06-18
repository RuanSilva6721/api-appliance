<?php

namespace Database\Factories;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $brand =Brand::first();
        return [
            'name' => $this->faker->word,
            'description' => $this->faker->sentence,
            'voltage' => Arr::random(['110v', '220v']),
            'brand_id' => $brand->id
        ];
    }
}
