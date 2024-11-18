<?php

namespace Database\Seeders;

use App\Modules\Product\Infrastructure\Models\Product;
use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         Product::factory(20)->create();
    }
}
