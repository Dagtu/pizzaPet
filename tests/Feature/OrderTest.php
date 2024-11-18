<?php

namespace Tests\Feature;

use Database\Seeders\ProductsSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->seed(ProductsSeeder::class);
    }
}
