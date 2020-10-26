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

function remember($key, $minutes, $callback)
{
    if ($value = Redis::get($key)) {
        return json_decode($value);
    }

    $value = $callback();

    Redis::setex($key, $minutes, $value);

    return $value;
}

Route::get('/', function () {
    return remember('articles.all', 60*60, function () {
        return App\Models\Article::all();
    });
});
