<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
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

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
