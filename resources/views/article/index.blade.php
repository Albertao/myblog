<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
@foreach($articles as $article)
    {{$article->slag}}<br>
    {{$article->title}}<br>
    {{$article->author}}<br>
    {{$article->content}}
@endforeach
{{$articles->render()}}
</body>
</html>