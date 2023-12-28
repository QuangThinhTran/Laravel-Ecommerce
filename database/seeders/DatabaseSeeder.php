<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Constant;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 3; $i++) {
            switch ($i) {
                case Constant::ROLE_ADMIN:
                    DB::table('role')->insert([
                        'name' => 'admin',
                    ]);
                    break;
                case Constant::ROLE_MERCHANT:
                    DB::table('role')->insert([
                        'name' => 'merchant',
                    ]);
                    break;
                case Constant::ROLE_USER:
                    DB::table('role')->insert([
                        'name' => 'user',
                    ]);
            }
        }

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

        $content = fake()->text();

        for ($i = 1; $i <= 12; $i++) {
            DB::table('posts')->insert([
                'content' => "{$content}",
                'user_id' => rand(1, 10)
            ]);
        }

        for ($i = 1; $i <= 12; $i++) {
            DB::table('category')->insert([
                'name' => fake()->unique()->name(),
            ]);
        }

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

        for ($i = 1; $i <= 30; $i++) {
            DB::table('images')->insert([
                'path' => 'image-' . rand(1, 20) . '.jpg',
                'product_id' => rand(1, 12)
            ]);
        }

        for ($i = 1; $i <= 5; $i++) {
            switch ($i) {
                case Constant::ORDER_PENDING:
                    DB::table('status')->insert([
                        'name' => 'pending',
                    ]);
                    break;
                case Constant::ORDER_SHIPPING:
                    DB::table('status')->insert([
                        'name' => 'shipping',
                    ]);
                    break;
                case Constant::ORDER_CONFIRMED:
                    DB::table('status')->insert([
                        'name' => 'confirmed',
                    ]);
                    break;
                case Constant::ORDER_PAID:
                    DB::table('status')->insert([
                        'name' => 'paid',
                    ]);
                    break;
                case Constant::ORDER_CANCEL:
                    DB::table('status')->insert([
                        'name' => 'cancel',
                    ]);
            }
        }
    }
}
