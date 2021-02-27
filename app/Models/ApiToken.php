<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class ApiToken extends Model
{
    /**
     * @inheritDoc
     */
    protected $fillable = [
        'token',
        'expires_at'
    ];

    public function IsTokenValid(string $token): bool
    {
        return ApiToken::whereToken($token)->valid()->exists();
    }

    public function scopeValid(Builder $builder): Builder
    {
        return $builder->where('expires_at', '>', now()->format('Y-m-d H:i:s'));
    }
}
