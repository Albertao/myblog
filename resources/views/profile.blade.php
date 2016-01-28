@extends('layouts.app')

@section('content')
    <div class="mdl-layout login-layout">
        <main class="mdl-layout__content">
            <div class="login-form mdl-grid">

                <div class="login-card mdl-card mdl-cell mdl-cell--12-col">
                    <div class="mdl-card__media mdl-color-text--amber-50" style="background-image: url('{{URL::asset('asset/img/tapet_2016-01-09_12-25-18_053_2880x2560.png')}}')">
                        <h3>Edit your profile</h3>
                    </div>
                    <div class="mdl-card__supporting-text mdl-color-text--grey-300 mdl-cell mdl-cell--8-col mdl-cell--middle">
                        @if(Session::has('error'))
                            <h4 class="mdl-color-text--accent">{{ Session::get('error') }}</h4>
                        @elseif(Session::has('success'))
                            <h4 class="mdl-color-text--accent">{{ Session::get('success') }}</h4>
                        @endif
                        <form action="{{ URL::route('edit') }}" method="post" id="profile" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label login-textfields">
                                <input type="text" style="color: #3f51b5;" class="mdl-textfield__input" id="name" name="name" value="{{ Auth::user()->name }}">
                                <label for="name" class="mdl-textfield__label">Your name</label>
                            </div>
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label login-textfields">
                                <textarea name="introduction" id="intro" style="color: #3f51b5;resize: none;" class="mdl-textfield__input" rows="1">{{ Auth::user()->introduction }}</textarea>
                                <label for="intro" class="mdl-textfield__label">Introduce yourself</label>
                            </div>
                            <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-1">
                                <input type="radio" id="option-1" class="mdl-radio__button" name="sex" value="1" {{ (Auth::user()->sex == 1) ? 'checked' : ''}}>
                                <span class="mdl-radio__label mdl-color-text--amber">Male</span>
                            </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-0">
                                <input type="radio" id="option-0" class="mdl-radio__button" name="sex" value="0" {{ (Auth::user()->sex == 0) ? 'checked' : ''}}>
                                <span class="mdl-radio__label mdl-color-text--accent">Female</span>
                            </label>
                            <input type="file" name="portrait" id="file" style="display: none;">
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label login-textfields">
                                <input type="text" style="color: #3f51b5;" class="mdl-textfield__input" id="fileName">
                                <label for="fileName" class="mdl-textfield__label">Upload your portraits</label>
                            </div>
                            <a id="fileButton" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--raised mdl-button--colored" onclick="$('input[id=file]').click();">选择文件</a>
                        </form>
                    </div>
                    <div class="mdl-card__actions mdl-card--border">
                        <div class="mdl-layout-spacer"></div>
                        <button type="submit" class="mdl-button mdl-js-button mdl-button--primary mdl-js-ripple-effect" form="profile">Save~!</button>
                    </div>
                </div>

            </div>
        </main>
    </div>
    <script src="{{URL::asset('asset/js/material.min.js')}}"></script>
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









