@extends('layouts.app')

@section('content')
<br />
<br />
<br />
<br />
<br />
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-10">
            <form  method="POST" id="signup-form" action="{{ route('register') }}" accept-charset="utf-8" class="myform form" role="form">
            @csrf
                <div class="row">
                    <div class="col-xs-6 col-md-6">
                        <input type="text" name="f_name" id="f_name" value="" class="form-control input-lg" placeholder="First Name" required autofocus />
                    </div>
                    <div class="col-xs-6 col-md-6">
                        <input type="text" name="l_name" id="l_name" value="" class="form-control input-lg" placeholder="Last Name" required />
                    </div>
                </div>
               <input type="email" name="email" id="email" value="" class="form-control input-lg" placeholder="Your Email" required />
                <span class="invalid-feedback pb20 hide" role="alert" id="up-email-alert"></span>
                @if ($errors->has('email'))
                    <span class="invalid-feedback pb20" role="alert">
                        {{ $errors->first('email') }}
                    </span>
                @endif
                <input type="password" name="password" id="password" value="" class="form-control input-lg" placeholder="Password" required />
                <input type="password" name="password_confirmation" id="password-confirm" value="" class="form-control input-lg" placeholder="Confirm Password" required />
                <span class="invalid-feedback pb20 hide" role="alert" id="up-pwd-alert"></span>
                @if ($errors->has('password'))
                    <span class="invalid-feedback pb20" role="alert">
                        {{ $errors->first('password') }}
                    </span>
                @endif
                <label>Birth Date</label>
                <div class="row">
                    <div class="col-xs-4 col-md-4">
                        <select name="month" class="form-control input-lg">
                            <option value="">Month</option>
                            <option value="01">Jan</option>
                            <option value="02">Feb</option>
                            <option value="03">Mar</option>
                            <option value="04">Apr</option>
                            <option value="05">May</option>
                            <option value="06">Jun</option>
                            <option value="07">Jul</option>
                            <option value="08">Aug</option>
                            <option value="09">Sep</option>
                            <option value="10">Oct</option>
                            <option value="11">Nov</option>
                            <option value="12">Dec</option>
                        </select>
                    </div>
                    <div class="col-xs-4 col-md-4">
                        <select name="day" class="form-control input-lg">
                            <option value="">Day</option>
                            <option value="01">1</option>
                            <option value="02">2</option>
                            <option value="03">3</option>
                            <option value="04">4</option>
                            <option value="05">5</option>
                            <option value="06">6</option>
                            <option value="07">7</option>
                            <option value="08">8</option>
                            <option value="09">9</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                            <option value="13">13</option>
                            <option value="14">14</option>
                            <option value="15">15</option>
                            <option value="16">16</option>
                            <option value="17">17</option>
                            <option value="18">18</option>
                            <option value="19">19</option>
                            <option value="21">21</option>
                            <option value="22">22</option>
                            <option value="23">23</option>
                            <option value="24">24</option>
                            <option value="25">25</option>
                            <option value="26">26</option>
                            <option value="27">27</option>
                            <option value="28">28</option>
                            <option value="29">29</option>
                            <option value="30">30</option>
                            <option value="31">31</option>
                        </select>
                    </div>
                    <div class="col-xs-4 col-md-4">
                        <select name="year" class="form-control input-lg">
                            <option value="">Year</option>
                            @for($i=1950; $i < 2019; $i++)
                            <option value="{{$i}}">{{$i}}</option>
                            @endfor
                        </select>
                    </div>
                </div>
                <label>Gender : </label>
                <label class="radio-inline">
                    <input type="radio" name="gender" value="M" id=male />Male
                </label>
                <label class="radio-inline">
                    <input type="radio" name="gender" value="F" id=female />Female
                </label>
                <br />
                <span class="help-block">By clicking Create my account, you agree to our Terms and that you have read our Data Use
                    Policy, including our Cookie Use.</span>
                <button class="btn btn-lg btn-primary btn-block signup-btn mb20" type="submit">
                    <span class="signup-btn-text">Create my account</span><div class="spinner-border alert-white center hide" id="signup-spinner"></div>
                </button>
                <p class="text-center mb10">Already have an account? <a href="{{ route('login') }}">Sign in here</a>.</p>
            </form>
        </div>
    </div>
</div>
@endsection
