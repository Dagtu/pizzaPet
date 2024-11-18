<?php

namespace Tests\Feature;

use App\Modules\User\Infrastructure\Models\AdminUser;
use App\Modules\User\Infrastructure\Models\Client;
use Database\Seeders\ProductsSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ProductsTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
    }

    public function test_get_products_client_when_has_products(): void
    {
        $this->artisan('migrate:fresh');
        $this->seed(ProductsSeeder::class);

        $response = $this->getJson(route('product.list.client'));

        $response->assertOk();
        $response->assertJsonStructure([
            '*' => [
                'id',
                'name',
                'type',
                'isActive',
                'price',
                'imageUrl',
                'description',
            ],
        ]);
    }

    public function test_get_products_client_when_has_no_products(): void
    {
        $response = $this->getJson(route('product.list.client'));

        $response->assertOk();
        $response->assertJsonCount(0);
    }

    public function test_get_product_by_id_when_exists(): void
    {
        $this->artisan('migrate:fresh');
        $this->seed(ProductsSeeder::class);

        $response = $this->getJson(route('product.get.by.id', ['id' => 1]));

        $response->assertOk();
        $response->assertJsonStructure([
            'id',
            'name',
            'type',
            'isActive',
            'price',
            'imageUrl',
            'description',
        ]);
    }

    public function test_get_product_by_id_when_not_exists(): void
    {
        $response = $this->getJson(route('product.get.by.id', ['id' => 100]));

        $response->assertStatus(404);
        $response->assertJson([
            'message' => 'Product not found'
        ]);
    }

    public function test_get_products_admin_when_has_products(): void
    {
        $this->artisan('migrate:fresh');
        $this->seed(ProductsSeeder::class);

        $adminUser = AdminUser::factory()->create();
        Sanctum::actingAs($adminUser, ['admin']);

        $response = $this->getJson(route('product.list.admin'));

        $response->assertOk();
        $response->assertJsonStructure([
            '*' => [
                'id',
                'name',
                'type',
                'isActive',
                'price',
                'imageUrl',
                'description',
            ],
        ]);
    }

    public function test_get_products_admin_without_auth()
    {
        $response = $this->getJson(route('product.list.admin'));
        $response->assertStatus(401);
    }

    public function test_get_products_admin_with_admin_without_abilities()
    {
        $user = AdminUser::factory()->create();
        Sanctum::actingAs($user);

        $response = $this->getJson(route('product.list.admin'));
        $response->assertStatus(403);
    }

    public function test_get_products_admin_with_admin_wrong_ability()
    {
        $user = AdminUser::factory()->create();
        Sanctum::actingAs($user, ['user']);

        $response = $this->getJson(route('product.list.admin'));
        $response->assertStatus(403);
    }

    public function test_get_products_admin_with_client_auth()
    {
        $client = Client::factory()->create();
        Sanctum::actingAs($client);

        $response = $this->getJson(route('product.list.admin'));
        $response->assertStatus(403);
    }

    public function test_get_products_admin_when_has_no_products(): void
    {
        $adminUser = AdminUser::factory()->create();
        Sanctum::actingAs($adminUser, ['admin']);

        $response = $this->getJson(route('product.list.admin'));

        $response->assertOk();
        $response->assertJsonCount(0);
    }

    public function test_create_product_with_valid_data(): void
    {
        $adminUser = AdminUser::factory()->create();
        Sanctum::actingAs($adminUser, ['admin']);

        $response = $this->postJson(route('product.create'), [
            'name' => 'test',
            'type' => 'pizza',
            'isActive' => true,
            'price' => 100,
            'imageUrl' => 'http://imagetesturl.com',
            'description' => 'test',
        ]);

        $response->assertStatus(201);
    }

    public function test_update_product_with_no_valid_data(): void
    {
        $adminUser = AdminUser::factory()->create();
        Sanctum::actingAs($adminUser, ['admin']);

        $response = $this->putJson(route('product.update.put', ['id' => 1]), [
            'name' => 'noVaild99',
            'type' => 'noVaild99',
            'isActive' => true,
            'price' => 100,
            'imageUrl' => 'noVaild99',
            'description' => 'test',
        ]);

        $response->assertBadRequest();
    }

    public function test_delete_product_when_not_exists(): void
    {
        $adminUser = AdminUser::factory()->create();
        Sanctum::actingAs($adminUser, ['admin']);

        $response = $this->deleteJson(route('product.delete', ['id' => 100]));

        $response->assertStatus(500);
    }

    public function test_delete_product_when_exists(): void
    {
        $this->artisan('migrate:fresh');
        $this->seed(ProductsSeeder::class);

        $adminUser = AdminUser::factory()->create();
        Sanctum::actingAs($adminUser, ['admin']);

        $response = $this->deleteJson(route('product.delete', ['id' => 1]));

        $response->assertOk();
    }
}
