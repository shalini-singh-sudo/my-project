<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

        for ($i = 0; $i < 10; $i++) {
            DB::table('products')->insert([
                'name' => $faker->word,                          
                'description' => $faker->sentence(15),             
                'price' => $faker->randomFloat(2, 10, 500),
                'image' => "image1.png", 
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
