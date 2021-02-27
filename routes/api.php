<?php

use App\Http\Controllers\Mails\ListEmails;
use App\Http\Controllers\Mails\SendEmails;
use App\Http\Middleware\CheckApiTokenInRequestBodyMiddleware;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/list', ListEmails::class)->middleware(CheckApiTokenInRequestBodyMiddleware::class);
Route::post('/send', SendEmails::class)->middleware(CheckApiTokenInRequestBodyMiddleware::class);
