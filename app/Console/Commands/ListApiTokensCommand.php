<?php

namespace App\Console\Commands;

use App\Models\ApiToken;
use Illuminate\Console\Command;

class ListApiTokensCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tokens:list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Lists available api tokens which are not expired';

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
        ApiToken::valid()->each(function ($api_token) {
            $this->info("Token: [{$api_token->token}] | Expires at: {$api_token->expires_at}");
        });

        return 0;
    }
}
