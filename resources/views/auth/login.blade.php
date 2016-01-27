@extends('layouts.app')

@section('content')
<div class="mdl-layout login-layout">
    <main class="mdl-layout__content">
        <div class="login-form mdl-grid">

            <div class="login-card mdl-card mdl-cell mdl-cell--12-col">
                <div class="mdl-card__media mdl-color-text--amber-50" style="background-image: url('{{URL::asset('asset/img/tapet_2016-01-09_12-25-18_053_2880x2560.png')}}')">
                    <h3>Login</h3>
                </div>
                <div class="mdl-card__supporting-text mdl-color-text--grey-300 mdl-cell mdl-cell--8-col mdl-cell--middle">
                    @if($errors->has('email'))
                        <h4 class="mdl-color-text--accent">{{ $errors->first('email') }}</h4>
                    @elseif($errors->has('password'))
                        <h4 class="mdl-color-text--accent">{{ $errors->first('password') }}</h4>
                    @endif
                    <form action="{{ url('/login') }}" method="post" id="login">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label login-textfields mdl-color-text--grey-300">
                            <input type="email" style="color: #3f51b5;" class="mdl-textfield__input{{ $errors->has('email') ? ' in_invalid' : '' }}" id="account" name="email" value="{{old ('email') }}">
                            <label for="account" class="mdl-textfield__label{{ $errors->has('email') ? ' in_invalid' : '' }}">Email-Address</label>
                        </div>
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label login-textfields">
                            <input type="password" style="color: #3f51b5;" class="mdl-textfield__input" id="passwd" name="password">
                            <label for="passwd" class="mdl-textfield__label">Password</label>
                        </div>
                        <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="reMe">
                            <input type="checkbox" name="remember" id="reMe" class="mdl-checkbox__input" checked>
                            <span class="mdl-checkbox__label mdl-color-text--blue-900">Remember me?</span>
                        </label>
                    </form>
                </div>
                <div class="mdl-card__actions mdl-card--border">
                    <a href="{{ url('/register') }}" class="mdl-button mdl-js-button mdl-button--primary mdl-js-ripple-effect">Register please~!</a>
                    <div class="mdl-layout-spacer"></div>
                    <a href="{{ url('/password/reset') }}" class="mdl-button mdl-js-button mdl-button--primary mdl-js-ripple-effect">Forgot your password?</a>
                    <button type="submit" class="mdl-button mdl-js-button mdl-button--primary mdl-js-ripple-effect" form="login">Go~</button>
                </div>
            </div>

        </div>
    </main>
</div>
<script src="{{URL::asset('asset/js/material.min.js')}}"></script>
@endsection
