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
    public function test_example(): void
    {

        $product = \App\Models\Product::factory()->create([ 
            'name' => 'test',
            'price' => 214.42,
        ]);

        \App\Models\Sell::create([
            'product_id' => $product->id,
            'price' => 250.50,
        ]);


        $product = \App\Models\Product::factory()->create([ 
            'name' => 'test',
            'price' => 214.42,
        ]);

        \App\Models\Sell::create([
            'product_id' => $product->id,
            'price' => 250.50,
            'created_at' => '2022-05-31 22:00:58',
        ]);

        $product = \App\Models\Product::factory()->create([ 
            'name' => 'test',
            'price' => 214.42,
        ]);

        \App\Models\Sell::create([
            'product_id' => $product->id,
            'price' => 250.50,
            'created_at' => '2022-04-31 22:00:58',
        ]);


        \App\Models\SellForecast::create([
            'price' => 250.50,
            'created_at' => '2022-04-31 00:00:00',   
        ]);

        \App\Models\SellForecast::create([
            'price' => 250.50,
            'created_at' => '2022-03-01 00:00:00',   
        ]);

        $response = $this->get('/api/sells/all');
        $response->assertStatus(200);
    }
}
