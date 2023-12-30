<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i <= 20; $i++) {
            DB::table('comments')->insert([
                'title' => fake()->title,
                'user_id' => rand(2, 10),
                'post_id' => rand(2, 12)
            ]);
        }

        for ($i = 0; $i <= 20; $i++) {
            DB::table('comment_child')->insert([
                'content' => fake()->title,
                'user_id' => rand(2, 10),
                'comment_id' => rand(1, 20)
            ]);
        }
    }
}
