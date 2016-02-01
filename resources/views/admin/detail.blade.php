@extends('layouts.admin')
@section('location')
    Article Edit
@endsection
@section('content')
    <main class="mdl-layout__content mdl-color--grey-100">
        <div class="demo-content mdl-grid">
            <div class="mdl-cell--12-col">
                @if(Session::has('result'))
                    <h3 class="mdl-color-text--amber">{{Session::get('result')}}</h3>
                @endif
                <form action="{{URL::route('admin::article::update', $id)}}" method="post" id="article" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="mdl-textfield mdl-js-textfield" style="width: 100%; color: #3f51b5;">
                        <input class="mdl-textfield__input" type="text" id="title" name="title" value="{{$article->title}}">
                        <label class="mdl-textfield__label" for="title">Article title here……</label>
                    </div>
                    <div class="mdl-textfield mdl-js-textfield" style="width: 100%; color: #3f51b5;">
                        <input class="mdl-textfield__input" type="text" id="title" name="slag" value="{{$article->slag}}">
                        <label class="mdl-textfield__label" for="title">Article slag here……</label>
                    </div>
                    <input type="file" name="article_image" id="file" style="display: none;">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label login-textfields">
                        <input type="text" style="color: #3f51b5;" class="mdl-textfield__input" id="fileName">
                        <label for="fileName" class="mdl-textfield__label">Upload your portraits</label>
                    </div>
                    <a id="fileButton" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--raised mdl-button--colored" onclick="$('input[id=file]').click();">选择文件</a>
                    <br>
                    <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp mdl-cell--12-col">
                        <thead>
                        <tr>
                            <th class="mdl-data-table__cell--non-numeric">Category</th>
                            <th>Name</th>
                            <th>Created_at</th>
                            <th>Last_updated</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td>
                                    <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="category{{$category->id}}">
                                        @if($article->categories->contains($category->id))
                                            <input type="checkbox" id="category{{$category->id}}" name="category[]" value="{{$category->id}}" class="mdl-checkbox__input" checked>
                                        @else
                                            <input type="checkbox" id="category{{$category->id}}" name="category[]" value="{{$category->id}}" class="mdl-checkbox__input">
                                        @endif
                                    </label>
                                </td>
                                <td>{{$category->name}}</td>
                                <td>{{$category->updated_at->diffForHumans()}}</td>
                                <td>{{$category->created_at->diffForHumans()}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                        <textarea name="content" id="" cols="30" rows="10">{{$article->content}}</textarea>
                        <script>
                            CKEDITOR.replace('content');

                        </script>
                    </table>
                </form>
                <button id="view-source" type="submit" form="article" class="mdl-button--fab mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-color--accent mdl-color-text--accent-contrast"><i class="material-icons">done</i></button>
            </div>
        </div>
    </main>
    <script src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
    <script>
        $(function(){
            $('input[id=file]').change(function () {
                //alert($(this).val());
                $('#fileName').val($(this).val());
            });
        });
    </script>
@endsection