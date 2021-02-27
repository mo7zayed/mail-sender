<?php

namespace Database\Seeders;

use App\Models\ApiToken;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ApiTokensSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ApiToken::create([
            'token' => Str::random(25),
            'expires_at' => now()->addHours(12)->format('Y-m-d H:i:s')
        ]);
    }
}
