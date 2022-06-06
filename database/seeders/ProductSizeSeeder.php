<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductSize;
use Illuminate\Support\Str;
class ProductSizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for ($i=1; $i < 50; $i++) { 
            for ($j=0; $j < 3; $j++) { 
                $product = new ProductSize();
                $product->product_id = $i;
                $product->size_id = rand(1, 10);
                $product->save();
            }
        }

    }
}
