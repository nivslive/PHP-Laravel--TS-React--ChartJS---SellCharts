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

        $this->call([
           ProductSeeder::class,
        ]);

        // \App\Models\User::factory(10)->create();
        $product = \App\Models\Product::factory()->create([ 
            'name' => 'test',
            'price' => 214.42,
        ]);

        // TODAY'S SELLS
        \App\Models\Sell::factory()->create([
            'product_id' => $product->id,
            'price' => 250.50,
        ]);

        // 2022 SELLS
        \App\Models\Sell::factory()->create([
            'product_id' => $product->id,
            'price' => 250.50,
            'created_at' => '2022-05-31 22:00:58',
        ]);

        \App\Models\Sell::factory()->create([
            'product_id' => $product->id,
            'price' => 250.50,
            'created_at' => '2022-04-31 22:00:58',
        ]);


        // 2021 SELLS
        \App\Models\Sell::factory()->create([
            'product_id' => $product->id,
            'price' => 250.50,
            'created_at' => '2021-03-31 22:00:58',
        ]);

        \App\Models\Sell::create([
            'product_id' => $product->id,
            'price' => 250.50,
            'created_at' => '2021-05-31 22:00:58',
        ]);

        \App\Models\Sell::factory()->create([
            'product_id' => $product->id,
            'price' => 250.50,
            'created_at' => '2021-02-31 22:00:58',
        ]);


        // 2020 SELLS
        \App\Models\Sell::factory()->create([
            'product_id' => $product->id,
            'price' => 250.50,
            'created_at' => '2020-03-31 22:00:58',
        ]);

        \App\Models\Sell::factory()->create([
            'product_id' => $product->id,
            'price' => 250.50,
            'created_at' => '2020-05-31 22:00:58',
        ]);

        \App\Models\Sell::factory()->create([
            'product_id' => $product->id,
            'price' => 250.50,
            'created_at' => '2020-02-31 22:00:58',
        ]);

        \App\Models\Sell::factory()->create([
            'product_id' => $product->id,
            'price' => 250.50,
            'created_at' => '2020-06-31 22:00:58',
        ]);

        \App\Models\Sell::factory()->create([
            'product_id' => $product->id,
            'price' => 250.50,
            'created_at' => '2020-10-31 22:00:58',
        ]);

        \App\Models\Sell::factory()->create([
            'product_id' => $product->id,
            'price' => 250.50,
            'created_at' => '2020-12-31 22:00:58',
        ]);


        // SELLS FORECASTS
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
