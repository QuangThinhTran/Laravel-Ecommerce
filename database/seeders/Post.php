<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Post extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $title = fake()->title();
        $content = fake()->text();

        for ($i = 1; $i <= 12; $i++) {
            DB::table('posts')->insert([
                'title' => "${$title}",
                'content' => "${$content}",
                'user_id' => rand(1, 10)
            ]);
        }
    }
}
