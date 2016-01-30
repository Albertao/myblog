@extends('layouts.admin')
@section('location')
    Article
@endsection
@section('content')
<main class="mdl-layout__content mdl-color--grey-100">
    <div class="demo-content mdl-grid">
        <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp demo-charts mdl-cell--12-col ">
            <thead>
            <tr>
                <th class="mdl-data-table__cell--non-numeric">Title</th>
                <th>Last updated</th>
                <th>operation</th>
            </tr>
            </thead>
            <tbody>
            @foreach($articles->sortByDesc('updated_at') as $article)
                <tr>
                    <td class="mdl-data-table__cell--non-numeric"><a href="{{URL::route('admin::article::show', $article->id)}}">{{$article->title}}</a></td>
                    <td>{{$article->updated_at->diffForHumans()}}</td>
                    <td>
                        @if($article->trashed())
                            <form action="{{URL::route('admin::article::restore', $article->id)}}" method="post">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <button type="submit" class="mdl-button operation">restore</button>
                            </form>
                        @else
                            <form action="{{URL::route('admin::article::delete', $article->id)}}" method="post">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <button type="submit" class="mdl-button mdl-js-button mdl-js-ripple-effect operation">delete</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{$articles->render()}}
    </div>
</main>
<a href="{{URL::route('admin::article::edit')}}" id="view-source" class="mdl-button--fab mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-color--accent mdl-color-text--accent-contrast"><i class="material-icons">add</i></a>
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