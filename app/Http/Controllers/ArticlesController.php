<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class ArticlesController extends Controller
{
    public function index()
    {
        $articles = Article::all();

        $inProgressIds = Redis::zrevrange('user.1.inProgress', 0, 2);

        $inProgress = collect($inProgressIds)->map(function ($id) {
            return Article::find($id);
        });

        return view('articles.index', compact('articles', 'inProgress'));
    }

    public function show(Article $article)
    {
        Redis::zadd('user.1.inProgress', time(), $article->id);

        return view('articles.show', compact('article'));
    }
}
