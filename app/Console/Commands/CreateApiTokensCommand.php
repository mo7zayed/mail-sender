<?php

namespace App\Console\Commands;

use App\Models\ApiToken;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class CreateApiTokensCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tokens:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates api tokens';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        ApiToken::create([
            'token' => Str::random(25),
            'expires_at' => now()->addHours(12)->format('Y-m-d H:i:s')
        ]);

        return 0;
    }
}
