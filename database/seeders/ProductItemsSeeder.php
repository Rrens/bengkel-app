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
        
    }
}
