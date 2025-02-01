<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            AdminUsersSeeder::class,
            ClientsSeeder::class,
            CouriersSeeder::class,
            ProductsSeeder::class,
        ]);
    }
}
