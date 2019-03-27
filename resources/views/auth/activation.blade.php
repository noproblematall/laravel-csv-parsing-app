@extends('layouts.app')

@section('content')
<br />
<br />
<br />
<br />
<br />
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 col-xs-11">
                <h2 class="mytext-dark-blue text-left underline">{{ __('Your account is not activated!') }}</h2>

                <div class="panel-body">
                    {{ __('You have to ask to Administrator. Thank you.') }}
                </div>
        </div>
    </div>
</div>
@endsection
