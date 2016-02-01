@extends('layouts.admin')
@section('location')
    Comment
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
                <form action="{{URL::route('admin::comment::search')}}" method="post">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable">
                        <label class="mdl-button mdl-js-button mdl-button--icon" for="searchComment">
                            <i class="material-icons">search</i>
                        </label>
                        <div class="mdl-textfield__expandable-holder">
                            <input class="mdl-textfield__input" type="text" id="searchComment" name="keyword">
                            <label class="mdl-textfield__label" for="sample-expandable">Expandable Input</label>
                        </div>
                    </div>
                    <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">search</button>
                </form>
            </div>
            <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp demo-charts mdl-cell--12-col ">
                <thead>
                <tr>
                    <th class="mdl-data-table__cell--non-numeric">Content</th>
                    <th>author</th>
                    <th>Last updated</th>
                    <th>operation</th>
                </tr>
                </thead>
                <tbody>
                @foreach($comments->sortByDesc('updated_at') as $comment)
                    <tr>
                        <td class="mdl-data-table__cell--non-numeric">{{$comment->content}}</td>
                        <td>{{$comment->author}}</td>
                        <td>{{$comment->updated_at->diffForHumans()}}</td>
                        <td>
                            @if($comment->trashed())
                                <form action="{{URL::route('admin::comment::restore', $comment->id)}}" method="post">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <button type="submit" class="mdl-button operation">restore</button>
                                </form>
                            @else
                                <form action="{{URL::route('admin::comment::delete', $comment->id)}}" method="post">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <button type="submit" class="mdl-button mdl-js-button mdl-js-ripple-effect operation">delete</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{$comments->render()}}
        </div>
    </main>
    <button type="submit" id="view-source" form="category" class="mdl-button--fab mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-color--accent mdl-color-text--accent-contrast"><i class="material-icons">add</i></button>
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