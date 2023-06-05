<?php

namespace Database\Seeders;

use App\Models\Stock;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class StockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for($i=0; $i<3; $i++){
            $stock = new Stock;
            $stock->date = $faker->date('Y_m_d');
            $stock->product_id = rand(1,10);
            $stock->supplier_id = rand(1,10);
            $stock->note = $faker->paragraph(1);
            $stock->save();
        }
    }
}
