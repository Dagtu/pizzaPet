<?php

namespace Database\Seeders;

use App\Modules\User\Infrastructure\Models\AdminUser;
use Illuminate\Database\Seeder;

class AdminUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AdminUser::factory()->count(10)->create();
    }
}
