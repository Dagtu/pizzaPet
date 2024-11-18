<?php

namespace Database\Seeders;

use App\Modules\Courier\Infrastructure\Models\Courier;
use Illuminate\Database\Seeder;

class CouriersSeeder extends Seeder
{
    public function run(): void
    {
        Courier::factory(10)->create();
    }
}
