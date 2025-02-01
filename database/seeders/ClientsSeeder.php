<?php

namespace Database\Seeders;

use App\Modules\User\Infrastructure\Models\Client;
use Illuminate\Database\Seeder;

class ClientsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Client::factory(10)->create();
    }
}
