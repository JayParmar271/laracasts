<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Articles</title>
</head>
<body>
    <h1>All Articles</h1>

    <ul>
        @foreach($articles as $article)
            <li>
                <a href="/article/{{$article->id}}">{{$article->title}}</a>
            </li>
        @endforeach
    </ul>

    <h1>Inprogress Articles</h1>

    <ul>
        @foreach($inProgress as $article)
            <li>
                <a href="/article/{{$article->id}}">{{$article->title}}</a>
            </li>
        @endforeach
    </ul>
</body>
</html>