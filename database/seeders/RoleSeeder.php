<?php

namespace Database\Seeders;

use App\Constant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
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
    }
}
