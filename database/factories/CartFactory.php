<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cart>
 */
class CartFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'item_id' => $this->faker->randomNumber(1, 1, 20),
            'user_id' => 1,
            'price' => $this->faker->numberBetween(10000, 1000000),
            'discount_item' => $this->faker->randomFloat(2, 1000, 5000),
            'total' => $this->faker->numberBetween(10000, 1000000),
        ];
    }
}
