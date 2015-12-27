<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
{{$articles->content}}<br>
@foreach($articles->comment as $comment)
    {{$comment->content}}<br>
@endforeach
{{!! Form::open() !!}}}

{{!! Form::close() !!}}}
</body>
</html>