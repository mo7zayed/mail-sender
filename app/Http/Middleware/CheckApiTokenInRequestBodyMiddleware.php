<?php

namespace App\Http\Middleware;

use App\Models\ApiToken;
use Closure;
use Illuminate\Http\Request;

class CheckApiTokenInRequestBodyMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!$request->has('api_token')) {
            return response([
                'success' => false,
                'message' => 'Api Token is missing, you need to pass [api_token] in your request body',
            ], 401);
        }

        if (!ApiToken::IsTokenValid($request->input('api_token'))) {
            return response([
                'success' => false,
                'message' => 'Api Token is not valid',
            ], 401);
        }

        return $next($request);
    }
}
