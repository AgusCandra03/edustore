<?php

namespace Database\Seeders;

use App\Models\Sales;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class SalesSeeder extends Seeder
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
            $sales = new Sales;
            $sales->user_id = rand(1,2);
            $sales->member_id = rand(1,20);
            $sales->product_id = rand(1,10);
            $sales->note = $faker->paragraph(1);
            $sales->save();
        }
    }
}
