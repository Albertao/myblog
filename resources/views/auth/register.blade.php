@extends('layouts.app')

@section('content')
<div class="mdl-layout register-layout">
    <main class="mdl-layout__content">
        <div class="register-form mdl-grid">
            <div class="register-card mdl-card mdl-cell mdl-cell--12-col">
                <div class="mdl-card__media mdl-color-text--amber-50" style="background-image: url('{{URL::asset('asset/img/tapet_2016-01-08_23-54-00_190_2880x2560.png')}}')">
                    <h3>Register</h3>
                </div>
                <div class="mdl-card__supporting-text mdl-color-text--grey-300 mdl-cell mdl-cell--8-col mdl-cell--middle">
                    @if($errors->has('email'))
                        <h4 class="mdl-color-text--accent">{{ $errors->first('email') }}</h4>
                    @elseif($errors->has('password'))
                        <h4 class="mdl-color-text--accent">{{ $errors->first('password') }}</h4>
                    @elseif($errors->has('name'))
                        <h4 class="mdl-color-text--accent">{{ $errors->first('name') }}</h4>
                    @elseif($errors->has('password_confirmation'))
                        <h4 class="mdl-color-text--accent">{{ $errors->first('password_confirmation') }}</h4>
                    @endif
                    <form action="{{ url('/register') }}" method="post" id="register">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label login-textfields mdl-color-text--grey-300">
                            <input type="text" style="color: #3f51b5;" class="mdl-textfield__input{{ $errors->has('name') ? ' in_invalid' : '' }}" id="username" name="name" value="{{old ('name') }}">
                            <label for="username" class="mdl-textfield__label{{ $errors->has('name') ? ' in_invalid' : '' }}">Username</label>
                        </div>
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label login-textfields mdl-color-text--grey-300">
                            <input type="email" style="color: #3f51b5;" class="mdl-textfield__input{{ $errors->has('email') ? ' in_invalid' : '' }}" id="account" name="email" value="{{old ('email') }}">
                            <label for="account" class="mdl-textfield__label{{ $errors->has('email') ? ' in_invalid' : '' }}">Email-Address</label>
                        </div>
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label login-textfields">
                            <input type="password" style="color: #3f51b5;" class="mdl-textfield__input" id="passwd" name="password">
                            <label for="passwd" class="mdl-textfield__label">Password</label>
                        </div>
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label login-textfields">
                            <input type="password" style="color: #3f51b5;" class="mdl-textfield__input" id="confirm" name="password_confirmation">
                            <label for="confirm" class="mdl-textfield__label">Confirm your password</label>
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
                    <button type="submit" class="mdl-button mdl-js-button mdl-button--primary mdl-js-ripple-effect" form="register">Go~</button>
                </div>
            </div>
        </div>
    </main>
</div>
<script src="{{URL::asset('asset/js/material.min.js')}}"></script>
@endsection









@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                        {!! csrf_field() !!}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="name" value="{{ old('name') }}">

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password_confirmation">

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-user"></i>Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
