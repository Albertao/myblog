@extends('layouts.admin')
@section('location')
    User
@endsection
@section('content')
    <main class="mdl-layout__content mdl-color--grey-100">
        <div class="demo-content mdl-grid">
            <div class="mdl-cell--12-col">
                @if(Session::has('success'))
                    <h3 class="mdl-color-text--blue">{{Session::get('success')}}</h3>
                @elseif(Session::has('error'))
                    <h3 class="mdl-color-text--red">{{Session::get('error')}}</h3>
                @endif
            </div>
            <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp demo-charts mdl-cell--12-col ">
                <thead>
                <tr>
                    <th class="mdl-data-table__cell--non-numeric">username</th>
                    <th>created_at</th>
                    <th>is_deleted</th>
                    <th>operation</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users->sortByDesc('updated_at') as $user)
                    <tr>
                        <td class="mdl-data-table__cell--non-numeric">{{$user->name}}</td>
                        <td>{{$user->created_at->diffForHumans()}}</td>
                        <td>
                            @if($user->trashed())
                                yes
                            @else
                                no
                            @endif
                        </td>
                        <td>
                            @if($user->trashed())
                                <form action="{{URL::route('admin::user::restore', $user->id)}}" method="post">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <button type="submit" class="mdl-button operation">restore</button>
                                </form>
                            @else
                                <form action="{{URL::route('admin::user::delete', $user->id)}}" method="post">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <button type="submit" class="mdl-button mdl-js-button mdl-js-ripple-effect operation">delete</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{$users->render()}}
        </div>
    </main>
    <script src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
    <script>
        $(function(){
            $('.pagination>li').children().addClass('mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--raised');
            $('.pagination>li').each(function(){
                if($(this).hasClass('disabled')){
                    $(this).children().attr('disabled', true);
                }else if($(this).hasClass('active')){
                    $(this).children().addClass('mdl-button--colored');
                }else{
                    $(this).children().addClass('mdl-color-text--blue');
                }
            });
        });
    </script>
@endsection