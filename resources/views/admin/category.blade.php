@extends('layouts.admin')
@section('location')
    Category
@endsection
@section('content')
    <main class="mdl-layout__content mdl-color--grey-100">
        <div class="demo-content mdl-grid">
            <div class="mdl-cell--12-col">
                @if(Session::has('result'))
                    <h3 class="mdl-color-text--amber">{{Session::get('result')}}</h3>
                @endif
                <form action="{{URL::route('admin::category::create')}}" id="category" method="post">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="mdl-textfield mdl-js-textfield" style="width: 100%; color: #3f51b5;">
                        <input class="mdl-textfield__input" type="text" id="title" name="name">
                        <label class="mdl-textfield__label" for="title">Category name here……</label>
                    </div>
                </form>
            </div>
            <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp demo-charts mdl-cell--12-col ">
                <thead>
                <tr>
                    <th class="mdl-data-table__cell--non-numeric">Name</th>
                    <th>Last updated</th>
                    <th>operation</th>
                </tr>
                </thead>
                <tbody>
                @foreach($categories->sortByDesc('updated_at') as $category)
                    <tr>
                        <td class="mdl-data-table__cell--non-numeric">{{$category->name}}</td>
                        <td>{{$category->updated_at->diffForHumans()}}</td>
                        <td>
                            @if($category->trashed())
                                <form action="{{URL::route('admin::article::restore', $category->id)}}" method="post">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <button type="submit" class="mdl-button operation">restore</button>
                                </form>
                            @else
                                <form action="{{URL::route('admin::category::delete', $category->id)}}" method="post">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <button type="submit" class="mdl-button mdl-js-button mdl-js-ripple-effect operation">delete</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{$categories->render()}}
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