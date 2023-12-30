<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttributesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 6; $i++) {
            DB::table('attributes')->insert([
                'name' => fake()->unique()->name(),
                'user_id' => rand(2,10)
            ]);
        }
//        for ($i = 1; $i <= 20; $i++) {
//            DB::table('attribute_child')->insert([
//                'name' => fake()->unique()->name(),
//                'description' => fake()->text(),
//                'price' => fake()->numerify(),
//                'attribute_id' => rand(1,6)
//            ]);
//        }
    }
}
