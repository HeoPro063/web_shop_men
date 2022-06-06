<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Str;
class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 50; $i++) { 
            //
            $product = new Product();
            $product->category_id = rand(21, 30);
            $product->name = Str::random(15);
            $product->price = rand(10000, 10000000);
            $product->quantity = rand(100, 1000);
            $product->purchases = rand(1, 1000);
            $product->description = Str::random(50);
            $product->save();
        }
    }
}
