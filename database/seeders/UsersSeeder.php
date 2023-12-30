<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 1; $i++) {
            DB::table('users')->insert([
                'name' => 'admin',
                'username' => 'admin',
                'email' => fake()->unique()->email,
                'password' => Hash::make('12345678'),
                'avatar' => 'avatar.svg',
                'role_id' => 1
            ]);
        }

        for ($i = 1; $i <= 3; $i++) {
            DB::table('users')->insert([
                'name' => fake()->name,
                'username' => fake()->unique()->userName,
                'email' => fake()->unique()->email,
                'password' => Hash::make('12345678'),
                'avatar' => 'avatar.svg',
                'role_id' => 2
            ]);
        }

        for ($i = 1; $i <= 6; $i++) {
            DB::table('users')->insert([
                'name' => fake()->name,
                'username' => fake()->unique()->userName,
                'email' => fake()->unique()->email,
                'password' => Hash::make('12345678'),
                'avatar' => 'avatar.svg',
                'role_id' => 3
            ]);
        }
    }
}
