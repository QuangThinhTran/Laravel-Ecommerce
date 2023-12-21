<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class User extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            DB::table('users')->insert([
                'name' => fake()->name,
                'username' => fake()->unique()->userName,
                'email' => fake()->unique()->email,
                'password' => '12345678',
                'avatar' => 'avatar.svg',
                'role_id' => 2
            ]);
        }
    }
}
