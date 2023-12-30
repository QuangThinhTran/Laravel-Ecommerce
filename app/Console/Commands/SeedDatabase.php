<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class SeedDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seed-database';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add data in database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Artisan::call('db:seed --class=RoleSeeder');
        Artisan::call('db:seed --class=UsersSeeder');
        Artisan::call('db:seed --class=StatusSeeder');
        Artisan::call('db:seed --class=CategorySeeder');
        Artisan::call('db:seed --class=PostsSeeder');
        Artisan::call('db:seed --class=ProductsSeeder');
        Artisan::call('db:seed --class=ImagesSeeder');
        Artisan::call('db:seed --class=CommentsSeeder');
        Artisan::call('db:seed --class=AttributesSeeder');
    }
}
