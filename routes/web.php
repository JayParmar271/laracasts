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

Route::get('articles/trending', function () {
    $trending = Redis::zrevrange('trending_articles', 0, 2);

    $trending = App\Models\Article::hydrate(
        array_map('json_decode', $trending)
    );

    return $trending;
});


Route::get('articles/{article}', function (App\Models\Article $article) {
    Redis::zincrby('trending_articles', 1, $article);

    // Set cron for remove extra items // Set into console/Kernel.php
    // Redis::zremrangebyrank('trending_articles', 0, -4);

    return $article;
});
