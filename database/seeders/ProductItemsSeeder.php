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

    // public function __construct(FakerFactory $faker)
    // {
    //     // parent::__construct();
    //     $this->faker = FakerFactory::create();
    // }

    public function run(): void
    {
        DB::table('product_items')->insert([
            [
                'barcode' => 'A001',
                'name' => 'Busi',
                'category_id' => 1,
                'price' => 10000,
                'stock' => 100,
            ],
            [
                'barcode' => 'A002',
                'name' => 'Rantai',
                'category_id' => 1,
                'price' => 25000,
                'stock' => 300,
            ],
        ]);
    }
}
