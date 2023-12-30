<?php

namespace Database\Seeders;

use App\Constant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
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
