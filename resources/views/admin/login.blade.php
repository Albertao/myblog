@extends('layouts.app')
@section('content')
    <form action="/admin/login" method="post">
        account:<input type="text" name="username"><br>
        password:<input type="password" name="password"><br>
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <input type="submit" name="submit">
    </form>
    {{dd(session()->all())}}
@endsection