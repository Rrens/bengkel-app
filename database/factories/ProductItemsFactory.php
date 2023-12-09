<?php

namespace Database\Factories;

use App\Models\ProductItems;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product_items>
 */
class ProductItemsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $last_number = ProductItems::max('barcode') ?? 0;
        $next_number = $last_number + 1;
        $formatted_number = sprintf('A%03d', $next_number);

        $itemTypes = ['Kampas Rem', 'Stir', 'Oli', 'Seal', 'Lampu', 'Filter Udara', 'Busi', 'Aki', 'Wiper', 'Radiator', 'Pompa Bensin'];
        $vehicleBrands = ['Toyota', 'Honda', 'Suzuki', 'Ford', 'Chevrolet', 'Nissan', 'Volkswagen', 'BMW', 'Mercedes-Benz', 'Audi', 'Hyundai', 'Kia', 'Mazda', 'Subaru', 'Jeep', 'Chrysler', 'Lexus', 'Acura', 'Volvo', 'Tesla', 'Porsche'];

        $itemType = $this->faker->randomElement($itemTypes);
        $vehicleBrand = $this->faker->randomElement($vehicleBrands);

        return [
            'barcode' => $formatted_number,
            'name' => "$itemType $vehicleBrand",
            'category_id' => $this->faker->numberBetween(1, 10),
            'stock' => $this->faker->numberBetween(10, 100),
            'price' => $this->faker->randomFloat(2, 10000, 200000)
        ];
    }
}
