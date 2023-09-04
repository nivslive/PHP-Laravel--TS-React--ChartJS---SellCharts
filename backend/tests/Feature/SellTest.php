<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SellTest extends TestCase
{

    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_must_have_exact_sum_of_sells(): void
    {

        $product = \App\Models\Product::factory()->create([ 
            'name' => 'test',
            'price' => 214.42,
        ]);

        \App\Models\Sell::create([
            'product_id' => $product->id,
            'price' => 250.50,
        ]);

        \App\Models\Sell::create([
            'product_id' => $product->id,
            'price' => 250.50,
        ]);
        
        $response = $this->get('/api/sells/all');
        $data = json_decode($response->content(), true);
        $this->assertEquals(501, $data["total_price_sells"][0]); 
        $response->assertStatus(200);
    }

    public function test_must_have_exact_sum_of_sells_by_year(): void
    {

        $product = \App\Models\Product::factory()->create([ 
            'name' => 'test',
            'price' => 214.42,
        ]);

        \App\Models\Sell::create([
            'product_id' => $product->id,
            'price' => 250.50,
            'created_at' => '2021-12-21 22:00:58',
        ]);

        \App\Models\Sell::create([
            'product_id' => $product->id,
            'price' => 250.50,
            'created_at' => '2021-12-31 22:00:58',
        ]);

        \App\Models\Sell::create([
            'product_id' => $product->id,
            'price' => 250.50,
            'created_at' => '2021-01-01 00:00:00', 
        ]);
        
        \App\Models\Sell::create([
            'product_id' => $product->id,
            'price' => 250.50,
            'created_at' => '2021-12-31 23:59:59',
        ]);

        $response = $this->get('/api/sells/year/2021');
        $data = json_decode($response->content(), true);
        $this->assertEquals(1002, $data["total_price_sells"][0]); 
        $response->assertStatus(200);
    }
}
