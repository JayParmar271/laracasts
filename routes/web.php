<?php

use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $user2Stats = [
        'favorites' => 10,
        'watchLaters' => 20,
        'completions' => 25,
    ];

    Redis::hmset('user.2.stats', $user2Stats);

    return Redis::hgetall('user.2.stats');
});

Route::get('users/{id}/stats', function ($id) {
    return Redis::hgetall("user.{$id}.stats");
});

Route::get('favorite-video', function () {
    Redis::hincrby('user.1.stats', 'favorites', 1);

    return redirect('/');
});
