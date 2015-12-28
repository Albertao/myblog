<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
{{$article->content}}<br>

{!! Form::open(['url' => '/comment', 'method' => 'post']) !!}

{!! Form::label('comment','评论内容') !!}

{!! Form::text('comment',null,['class' => 'comment']) !!}

{!! Form::hidden('articleId',$id) !!}
{!! Form::hidden('parent_id',0) !!}

{!! Form::submit('发表评论') !!}

{!! Form::close() !!}
</body>
</html>