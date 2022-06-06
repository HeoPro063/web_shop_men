<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ImageProduct;
class ImageProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        for ($i = 1; $i <= 50; $i++) { 
            for ($j = 0; $j < 2; $j++) { 
                $image = new ImageProduct;
                $image->product_id = $i;
                $image->name = rand(1, 9).'.jpg';
                $image->save();
            }
        }
    }
}
