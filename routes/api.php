<?php

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

$api_version = config('api.api_version');
Route::group(['prefix' => "{$api_version}"], function() {
	Route::prefix('auth')->group(base_path('routes/api/auth.php'));
	Route::prefix('users')->group(base_path('routes/api/users.php'));
	Route::prefix('articles')->group(base_path('routes/api/articles.php'));
});
