<?php

namespace Database\Seeders;

use App\Models\ProductItems;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as FakerFactory;
use Illuminate\Support\Facades\DB;

class ProductItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    protected $faker;

    public function __construct(FakerFactory $faker)
    {
        // parent::__construct();
        $this->faker = FakerFactory::create();
    }

    public function run(): void
    {
        // ProductItems::factory(20)->create();
        $itemTypes = ['Kampas Rem', 'Stir', 'Oli', 'Seal', 'Lampu', 'Filter Udara', 'Busi', 'Aki', 'Wiper', 'Radiator', 'Pompa Bensin'];
        $vehicleBrands = ['Toyota', 'Honda', 'Suzuki', 'Ford', 'Chevrolet', 'Nissan', 'Volkswagen', 'BMW', 'Mercedes-Benz', 'Audi', 'Hyundai', 'Kia', 'Mazda', 'Subaru', 'Jeep', 'Chrysler', 'Lexus', 'Acura', 'Volvo', 'Tesla', 'Porsche'];

        foreach (range(1, 10) as $i) {
            $itemType = $itemTypes[array_rand($itemTypes)];
            $vehicleBrand = $vehicleBrands[array_rand($vehicleBrands)];
            $last_number = ProductItems::count();
            $next_number = $last_number + 1;
            $formatted_number = sprintf('A%03d', $next_number);

            DB::table('product_items')->insert([
                'barcode' => $formatted_number,
                'category_id' => $this->faker->numberBetween(1, 10),
                'name' => "$itemType $vehicleBrand",
                'stock' => $this->faker->numberBetween(10, 100),
                'price' => $this->faker->randomFloat(2, 10000, 200000),
            ]);
        }
    }
}
