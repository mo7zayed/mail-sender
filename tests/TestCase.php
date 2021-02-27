<?php

namespace Tests;

use App\Models\ApiToken;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, RefreshDatabase;

    public function api($method, $uri, array $data = [], array $headers = [])
    {
        return $this->json($method, $uri, $data, $headers);
    }

    public function createToken()
    {
        return ApiToken::create([
            'token' => Str::random(25),
            'expires_at' => now()->addHours(12)->format('Y-m-d H:i:s')
        ])->token;
    }

    public function getRequestTemplate(string $template)
    {
        return json_decode(
            File::get(base_path("tests/Feature/templates/{$template}.json")),
            true
        );
    }
}
