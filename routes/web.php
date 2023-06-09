<?php

use App\Http\Middleware\AuthCheck;
use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::prefix('/auth')->group(function () {
    Route::post('/register', [App\Http\Controllers\UsersController::class, 'register']);
    Route::post('/login', [App\Http\Controllers\UsersController::class, 'login']);
    Route::get('/logout', [App\Http\Controllers\UsersController::class, 'logout']);
});

Route::post('/create_tweet', [App\Http\Controllers\TweetsController::class, 'create'])->middleware(Authenticate::class);

Route::get('/get_user', [App\Http\Controllers\UsersController::class, 'getUser']);
Route::get('/get_tweets_by_user', [App\Http\Controllers\TweetsController::class, 'getByUser']);
Route::get('/get_all_tweets', [App\Http\Controllers\TweetsController::class, 'getAll']);

Route::fallback(function () {
    return view('app');
});
