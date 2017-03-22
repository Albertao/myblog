@extends('layouts.admin')
@section('location')
    Article Edit
@endsection
@section('extra_js')
    <script src="/asset/js/editormd.min.js"></script>
    <script src="/asset/js/select2.full.min.js"></script>
    <script>
        $(function() {
            $(".category").select2({
                placeholder: "type the category name here"
            });
            var editor = editormd("content", {
                path : "/asset/js/lib/", // Autoload modules mode, codemirror, marked... dependents libs path
                height: 500,
                saveHTMLToTextarea: true,
            });
            $("#view-source").on("click", function () {
                $("#content-textarea").val(editor.getPreviewedHTML());
                $("#article").submit();
            });
        });
    </script>
@endsection
@section('extra_css')
    <link rel="stylesheet" href="http://apps.bdimg.com/libs/fontawesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/asset/css/editormd.min.css">
    <link rel="stylesheet" href="/asset/css/select2.min.css">
@endsection
@section('content')
<main class="mdl-layout__content mdl-color--grey-100">
    <div class="demo-content mdl-grid">
        <div class="mdl-cell--12-col">
            @if(Session::has('result'))
                <h3 class="mdl-color-text--amber">{{Session::get('result')}}</h3>
            @endif
            <form action="{{URL::route('admin::article::post')}}" method="post" id="article" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <div class="mdl-textfield mdl-js-textfield" style="width: 100%; color: #3f51b5;">
                    <input class="mdl-textfield__input" type="text" id="title" name="title">
                    <label class="mdl-textfield__label" for="title">Article title here……</label>
                </div>
                <div class="mdl-textfield mdl-js-textfield" style="width: 100%; color: #3f51b5;">
                    <input class="mdl-textfield__input" type="text" id="title" name="slag">
                    <label class="mdl-textfield__label" for="title">Article slag here……</label>
                </div>
                <input type="file" name="article_image" id="file" style="display: none;">
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label login-textfields">
                    <input type="text" style="color: #3f51b5;" class="mdl-textfield__input" id="fileName">
                    <label for="fileName" class="mdl-textfield__label">Upload your portraits</label>
                </div>
                <a id="fileButton" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--raised mdl-button--colored" onclick="$('input[id=file]').click();">选择文件</a>
                <br>
                <div class="mdl-textfield mdl-js-textfield" style="width: 100%;">
                    <select name="category[]" class="category js-example-basic-multiple mdl-textfield__input" id="category" multiple="multiple">
                        @foreach($categories as $cate)
                            @if($cate->trashed())
                                <option value="{{$cate->id}}" disabled="disabled">{{$cate->name}}</option>
                            @else
                                <option value="{{$cate->id}}">{{$cate->name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div id="content" style="height: 100%; !important;">
                    <textarea style="display:none;" name="content-md">### Hello World !</textarea>
                    <textarea class="editormd-html-textarea" name="content" id="content-textarea"></textarea>
                </div>
            </form>

            <button id="view-source" type="button" class="mdl-button--fab mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-color--accent mdl-color-text--accent-contrast"><i class="material-icons">done</i></button>
        </div>
    </div>
</main>
<script>
    $(function(){
        $('input[id=file]').change(function () {
            //alert($(this).val());
            $('#fileName').val($(this).val());
        });
    });
</script>
@endsection