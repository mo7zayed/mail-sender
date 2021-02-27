<?php

namespace Database\Seeders;

use App\Console\Commands\CreateApiTokensCommand;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class ApiTokensSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Artisan::call(CreateApiTokensCommand::class);
    }
}
