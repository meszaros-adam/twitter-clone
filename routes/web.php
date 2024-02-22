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
Route::post('/update_user', [App\Http\Controllers\UsersController::class, 'updateUser'])->middleware(Authenticate::class);
Route::post('/update_password', [App\Http\Controllers\UsersController::class, 'updatePassword'])->middleware(Authenticate::class);

Route::get('/get_tweets_by_user', [App\Http\Controllers\TweetsController::class, 'getByUser']);
Route::get('/get_tweets_by_follow', [App\Http\Controllers\TweetsController::class, 'getFolloweds'])->middleware(Authenticate::class);
Route::get('/get_all_tweets', [App\Http\Controllers\TweetsController::class, 'getAll']);

Route::post('/create_follow', [\App\Http\Controllers\FollowsController::class, 'createFollow'])->middleware(Authenticate::class);
Route::post('/delete_follow', [\App\Http\Controllers\FollowsController::class, 'deleteFollow'])->middleware(Authenticate::class);
Route::get('/get_followed_list', [\App\Http\Controllers\FollowsController::class, 'getFollowedList'])->middleware(Authenticate::class);

Route::post('/create_retweet', [\App\Http\Controllers\RetweetsController::class, 'createRetweet'])->middleware(Authenticate::class);
Route::post('/delete_retweet', [\App\Http\Controllers\RetweetsController::class, 'deleteRetweet'])->middleware(Authenticate::class);

Route::post('/create_comment', [\App\Http\Controllers\CommentsController::class, 'createComment'])->middleware(Authenticate::class);
Route::get('/get_comments', [\App\Http\Controllers\CommentsController::class, 'getComments']);

Route::post('/upload-image', [\App\Http\Controllers\ImageController::class, 'upload']);

Route::fallback(function () {
    return view('app');
});
