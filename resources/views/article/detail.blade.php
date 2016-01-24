<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
{{$article->content}}<br>
<form action="/comment" method="post">
    <input type="hidden" name="_token" value="{{csrf_token()}}">
    <input type="hidden" name="articleId" value="{{$id}}">
    <input type="hidden" name="parent_id" value="0">
    <input type="text" name="comment">
    <input type="submit" value="提交">
</form>

@if(Auth::user())
{{Auth::user()->name}}
@else
    游客，欢迎
    @endif
{{dd(Session::all())}}
</body>
</html>