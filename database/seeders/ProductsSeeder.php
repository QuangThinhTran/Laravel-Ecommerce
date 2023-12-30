<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 12; $i++) {
            DB::table('products')->insert([
                'name' => fake()->name(),
                'code' => fake()->unique()->currencyCode(),
                'price' => fake()->numerify(),
                'description' => fake()->text(),
                'category_id' => rand(1, 4),
                'user_id' => rand(2, 6),
                'post_id' => rand(1, 12)
            ]);
        }
    }
}
