@extends('layouts.app')
@section('content')
    <form action="/admin/login" method="post">
        account:<input type="text" name="username"><br>
        password:<input type="password" name="password"><br>
        <input type="submit" name="submit">
    </form>
    {{dd(Session::all())}}
@endsection