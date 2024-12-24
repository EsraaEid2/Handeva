<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 10) as $index) { 
            DB::table('products')->insert([
                'title' => $faker->words(3, true), 
                'description' => $faker->sentence(10),
                'price' => $faker->randomFloat(2, 5, 100),
                'stock_quantity' => $faker->numberBetween(1, 50),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}