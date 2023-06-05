<?php

namespace Database\Seeders;

use App\Models\Product;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for($i=0; $i<5; $i++){
            $product = new Product;
            $product->code = 'A00'.$faker->randomNumber(2);
            $product->name = $faker->jobTitle;
            $product->description = $faker->paragraph(1);
            $product->stock = rand(10,30);
            $product->price = rand(100000,1000000);
            $product->category_id = rand(1,5);
            $product->save();
        }
    }
}
