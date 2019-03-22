@extends('layouts.app')
@section('styles')

@endsection

@section('content')
<section class="probootstrap-section" id="working-area" data-section="working-area">
<div class="container bootstrap snippet">
    <div class="row">
        <div class="col-sm-3">
            <div class="text-center">
                <img src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png" width="202" height="202" class="avatar img-circle img-thumbnail"
                    alt="avatar">
                <h6>Upload a different photo...</h6>
                <input type="file" class="text-center center-block file-upload">
            </div>
            <hr><br>


            <div class="panel panel-default">
                <div class="panel-heading"><strong>Website</strong> <i class="fa fa-link fa-1x"></i></div>
                <div class="panel-body text-center"><a href="{{config('app.url')}}">{{config('app.name')}}</a></div>
            </div>


            <ul class="list-group mytext-dark-blue">
                <li class="list-group-item text-muted mytext-dark-blue"><strong>Activity</strong> <i class="fas fa-tachometer-alt"></i></li>
                <li class="list-group-item text-right"><span class="pull-left">Current plan</span> 10000</li>
                <li class="list-group-item text-right"><span class="pull-left">Processable rows</span> 8000</li>
                <li class="list-group-item text-right"><span class="pull-left">Completed Activities</span> 3</li>
                <li class="list-group-item text-right"><span class="pull-left">Activities in process</span> 5</li>
            </ul>

        </div>
        <!--/col-3-->
        <div class="col-sm-9">
            <ul class="nav nav-tabs">
                <li><a data-toggle="tab" class="mytext-red" href="#home">Home</a></li>
                <li class="active"><a data-toggle="tab" class="mytext-red" href="#processing">Activities in process</a></li>
                <li><a data-toggle="tab" class="mytext-red" href="#completed">Completed Activities</a></li>
            </ul>


            <div class="tab-content">
                <div class="tab-pane mytext-dark-blue" id="home">
                    <hr>
                    <form class="form myform" action="" method="post" id="registrationForm">
                        <div class="form-group">

                            <div class="col-xs-6">
                                <label for="first_name">
                                    <h4 class="mb10">First name</h4>
                                </label>
                                <input type="text" class="form-control" name="first_name" id="first_name"
                                    placeholder="first name" value="{{Auth::user()->f_name}}" title="enter your first name if any.">
                            </div>
                        </div>
                        <div class="form-group">

                            <div class="col-xs-6">
                                <label for="last_name">
                                    <h4 class="mb10">Last name</h4>
                                </label>
                                <input type="text" class="form-control" name="last_name" id="last_name"
                                    placeholder="last name" value="{{Auth::user()->l_name}}" title="enter your last name if any.">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="email">
                                    <h4 class="mb10">Email</h4>
                                </label>
                                <input type="email" class="form-control" name="email" id="email"
                                    placeholder="you@email.com" value="{{Auth::user()->email}}" disabled title="enter your email.">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="mobile">
                                    <h4 class="mb10">Birthday</h4>
                                </label>
                                <input type="text" class="form-control" name="birth" id="birth"
                                    placeholder="enter mobile number" value="{{Auth::user()->birthday}}" title="enter your birthday if any.">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="mobile">
                                    <h4 class="mb10">Mobile</h4>
                                </label>
                                <input type="text" class="form-control" name="mobile" id="mobile"
                                    placeholder="enter mobile number" value="{{Auth::user()->mobile}}" title="enter your mobile number if any.">
                            </div>
                        </div>
                        <div class="form-group">

                            <div class="col-xs-6">
                                <label for="email">
                                    <h4 class="mb10">Location</h4>
                                </label>
                                <input type="email" class="form-control" id="location" placeholder="somewhere" value="{{Auth::user()->location}}"
                                    title="enter a location">
                            </div>
                        </div>
                        <div class="form-group">

                            <div class="col-xs-6">
                                <label for="password">
                                    <h4 class="mb10">Password</h4>
                                </label>
                                <input type="password" class="form-control" name="password" id="password"
                                    placeholder="password" title="enter your password.">
                            </div>
                        </div>
                        <div class="form-group">

                            <div class="col-xs-6">
                                <label for="password2">
                                    <h4 class="mb10">Verify</h4>
                                </label>
                                <input type="password" class="form-control" name="password2" id="password2"
                                    placeholder="confirm password" title="Confirm password.">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <br>
                                <div class="right" style="display: inline-block">
                                    <button class="btn btn-lg btn-default" type="reset"><i class="fas fa-redo"></i> Reset</button>
                                    <button class="btn btn-lg btn-primary" type="submit"><i class="far fa-check-circle"></i> Save</button>
                                </div>
                                <div class="clear"></div>
                            </div>
                        </div>
                    </form>
                </div>
                <!--/tab-pane-->
                <div class="tab-pane active mytext-dark-blue" id="processing">
                    <hr>
                    
                </div>
                <!--/tab-pane-->
                <div class="tab-pane mytext-dark-blue" id="completed">
                    <hr>
                    
                </div>

            </div>
            <!--/tab-pane-->
        </div>
        <!--/tab-content-->

    </div>
    <!--/col-9-->
</div>
<!--/row-->
</section>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {

            var readURL = function(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('.avatar').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }

            $(".file-upload").on('change', function(){
                readURL(this);
            });
        });
    </script>
@endsection