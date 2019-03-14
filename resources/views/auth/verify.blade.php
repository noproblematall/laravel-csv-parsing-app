@extends('layout')

@section('content')
<br />
<br />
<br />
<br />
<br />
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 col-xs-11">
                <h2 class="mytext-dark-blue text-left underline">{{ __('Verify Your Email Address') }}</h2>

                <div class="panel-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }}, <a href="{{ route('verification.resend') }}">{{ __('click here to request another') }}</a>.
                </div>
        </div>
    </div>
</div>
@endsection
