<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TermsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 40; $i++) {
            DB::table('terms')->insert([
                'name' => fake()->unique()->name(),
                'description' => fake()->text(),
                'attribute_id' => rand(1, 20),
                'is_active' => rand(0, 1)
            ]);
        }
    }
}
