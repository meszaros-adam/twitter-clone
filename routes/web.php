<?php

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

Route::prefix('auth')->group(function () {
    Route::post('/register', [App\Http\Controllers\UsersController::class, 'register']);
    Route::post('/login', [App\Http\Controllers\UsersController::class, 'login']);
    Route::get('/logout', [App\Http\Controllers\UsersController::class, 'logout']);
});

Route::post('/create_tweet', [App\Http\Controllers\TweetsController::class, 'create']);



Route::fallback(function () {
    return view('app');
});
