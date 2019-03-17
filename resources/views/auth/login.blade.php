@extends('layouts.app')
@section('styles')

@endsection

@section('content')
<section class="probootstrap-section" id="working-area" data-section="working-area">
    <input type="hidden" name="_page" id="_page" value="login" />
    <br />
    <br />
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-6">
                <form  method="POST" action="{{ route('login') }}" id="signin-form" accept-charset="utf-8" class="myform form" role="form">
                <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}" />
                <label for="email">Email:</label>
                <input type="text" name="email" id="email" class="form-control input-lg{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Your Email" value="{{ old('email') }}" required autofocus />
                <span class="invalid-feedback pb20 hide" role="alert" id="in-email-alert"></span>
                @if ($errors->has('email'))
                    <span class="invalid-feedback pb20" role="alert">
                        {{ $errors->first('email') }}
                    </span>
                @endif
                <label class="left" for="password">Password: </label>
                @if (Route::has('password.request'))
                    <a class="btn btn-link forgot-pwd right" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                @endif
                <input type="password" name="password" id="password" value="" class="form-control input-lg mb20{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Password" required />
                <span class="invalid-feedback pb20 hide" role="alert" id="in-pwd-alert"></span>
                @if ($errors->has('password'))
                    <span class="invalid-feedback pb20" role="alert">
                        {{ $errors->first('password') }}
                    </span>
                @endif
                <input type="checkbox" name="remember_me" id="remember_me" /> <label for="remember_me">Remember me</label>
                <br />
                <br />
                <button class="btn btn-lg btn-primary btn-block signin-btn mb20" type="button">
                    <span class="signin-btn-text">Sign in</span><div class="spinner-border alert-white hide center" id="signin-spinner"></div>
                </button>
                <p class="text-center mb10">Don't have an account? <a href="{{ route('register') }}">Sign up here</a>.</p>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection

@section('scripts')
    <script src="{{asset('bower_components/resumablejs/resumable.js')}}" type="application/javascript"></script>
    <script src="{{asset('assets/js/upload.js')}}"></script>
@endsection