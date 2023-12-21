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
        Artisan::call('db:seed --class=Role');
        Artisan::call('db:seed --class=User');
        Artisan::call('db:seed --class=Post');
        Artisan::call('db:seed --class=Images');
    }
}
