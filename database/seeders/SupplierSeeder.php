<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for($i=0; $i<10; $i++){
            $supplier = new Supplier;
            $supplier->name = $faker->company;
            $supplier->address = $faker->address;
            $supplier->phone_number = '0711'.$faker->randomNumber(8);
            $supplier->description = $faker->paragraph(1);
            $supplier->save();
        }
    }
}
