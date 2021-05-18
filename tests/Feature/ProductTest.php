<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Faker\Factory;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_a_product_can_be_created()
    {
        $faker = Factory::create();
        $user = User::factory()->create();
        Sanctum::actingAs($user, ['*']);

        $response = $this->post('/api/products', [
            'title' => $faker->title,
            'price' => $faker->randomFloat(2),
        ]);
        $response->assertCreated();

        $this->assertEquals(1, Product::all()->count());
    }

    public function test_failing_on_absence_of_product()
    {
        $response = $this->get('/api/products');

        $this->assertEquals(0, $response->json('total'));
    }

    public function test_getting_product()
    {
        $product = Product::factory()->create();

        $response = $this->get('/api/products/1');

        $this->assertEquals($product->title, $response->json('title'));
    }

    public function test_update_product_price()
    {
        $product = Product::factory()->create();

        $user = User::factory()->create();
        Sanctum::actingAs($user, ['*']);

        $this->put('/api/products/1', [
            'price' => 12.99,
        ]);

        $this->assertEquals(
            Product::find($product->id)->first()->price,
            12.99
        );
    }
}
