@extends('layouts.app')
@section('styles')
<link rel="stylesheet" href="{{asset('assets/vendor/dataTables/datatables.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/dataTables/awesome-bootstrap-checkbox.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/dataTables/dataTables.checkboxes.css')}}">
@endsection

@section('content')
<section class="probootstrap-section" id="working-area" data-section="working-area">

<div class="container bootstrap snippet">
    <div class="row">
        <div class="col-sm-3 mobile-hide">
            <div class="text-center" id="brand-img">
                
            </div>
            <hr><br>
            <div class="panel panel-default">
                <div class="panel-heading"><strong>Website</strong> <i class="fas fa-link"></i></div>
                <div class="panel-body text-center"><a href="{{config('app.url')}}">{{config('app.name')}}</a></div>
            </div>
            <ul class="list-group mytext-dark-blue">
                <li class="list-group-item text-muted mytext-dark-blue"><strong>Activity</strong> <i class="fas fa-tachometer-alt"></i></li>
                <li class="list-group-item text-right"><span class="pull-left">Current plan</span> 10000</li>
                <li class="list-group-item text-right"><span class="pull-left">Processable rows</span> 8000</li>
                <li class="list-group-item text-right"><span class="pull-left">Completed Activities</span>{{$completed_files_count}}</li>
                <li class="list-group-item text-right"><span class="pull-left">Activities in process</span>{{$processing_files_count}}</li>
            </ul>
        </div>
        <div class="col-sm-9 col-12" id="dash-right">
            <ul class="nav nav-tabs hide">
                <li class="<?php if($active=='completed') echo 'active'; ?>"><a data-toggle="tab" class="mytext-red" href="#completed">Completed Activities</a></li>
                <li class="<?php if($active=='processing') echo 'active'; ?>"><a data-toggle="tab" class="mytext-red" href="#processing">Activities in process</a></li>
                <li class="<?php if($active=='info') echo 'active'; ?>"><a data-toggle="tab" class="mytext-red" href="#info">Personal info</a></li>
                <li class="<?php if($active=='chang_pwd') echo 'active'; ?>"><a data-toggle="tab" class="mytext-red" href="#chang_pwd">Change password</a></li>
                <li class="<?php if($active=='membership') echo 'active'; ?>"><a data-toggle="tab" class="mytext-red" href="#membership">Manage membership</a></li>
            </ul>


            <div class="tab-content">

                <div class="tab-pane mytext-dark-blue <?php if($active=='completed') echo 'active'; ?>" id="completed">
                    <hr>
                    <table id="completed-list-table" class="table table-bordered table-striped" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th></th>        
                                <th>File Name</th>
                                <th>Processed rows</th>
                                <th>Dataset</th>
                                <th>Completed date</th>
                                <th>Download</th>
                            </tr>
                        </thead>
                    </table>

                    <table id="mobile-completed-list-table" class="table table-bordered table-striped" cellspacing="0" width="100%">
                        <thead>
                            <tr>     
                                <th>File Name</th>
                                <th>Dataset</th>
                                <th class="text-center"><i class="fas fa-download"></i></th>
                            </tr>
                        </thead>
                    </table>
                </div>

                <div class="tab-pane mytext-dark-blue <?php if($active=='processing') echo 'active'; ?>" id="processing">
                    <hr>
                    <table id="in-process-table" class="table table-bordered table-striped" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th></th>        
                                <th>File Name</th>
                                <th>Processed rows</th>
                                <th>Dataset</th>
                                <th>Status</th>
                                <th>Start date</th>
                            </tr>
                        </thead>
                    </table>

                    <table id="mobile-in-process-table" class="table table-bordered table-striped" cellspacing="0" width="100%">
                        <thead>
                            <tr>    
                                <th>File Name</th>
                                <th>rows</th>
                                <th>Dataset</th>
                            </tr>
                        </thead>
                    </table>
                </div>

                <div class="tab-pane info_tab mytext-dark-blue <?php if($active=='info') echo 'active'; ?>" id="info">
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
                                <input type="email" class="form-control" name="email" id="p_email"
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
                                <label for="location">
                                    <h4 class="mb10">Location</h4>
                                </label>
                                <input type="text" class="form-control" id="location" placeholder="somewhere" value="{{Auth::user()->location}}"
                                    title="enter a location">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <br>
                                <div class="right" style="display: inline-block">
                                    <button class="btn btn-default" type="reset"><i class="fas fa-redo"></i> Reset</button>
                                    <button class="btn btn-primary" type="submit"><i class="far fa-check-circle"></i> Save</button>
                                </div>
                                <div class="clear"></div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="tab-pane mytext-dark-blue <?php if($active=='chang_pwd') echo 'active'; ?>" id="chang_pwd">
                    <hr>
                    <form class="form myform" action="" method="post" id="change_pwd_form">
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="password">
                                    <h4 class="mb10">Password</h4>
                                </label>
                                <input type="password" class="form-control" name="password" id="p_password"
                                    placeholder="password" title="enter your password." required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="password2">
                                    <h4 class="mb10">Verify</h4>
                                </label>
                                <input type="password" class="form-control" name="password2" id="password2"
                                    placeholder="confirm password" title="Confirm password." required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <br>
                                <div class="right" style="display: inline-block">
                                    <button class="btn btn-default" type="reset"><i class="fas fa-redo"></i> Reset</button>
                                    <button class="btn btn-primary" type="submit"><i class="far fa-check-circle"></i> Save</button>
                                </div>
                                <div class="clear"></div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="tab-pane mytext-dark-blue <?php if($active=='membership') echo 'active'; ?>" id="membership">
                    <hr>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="probootstrap-pricing">
                                <h2>Starter</h2>
                                <p class="probootstrap-price"><strong>$22.99</strong></p>
                                <p class="probootstrap-note">This is a monthly recurring payment.</p>
                                <ul class="probootstrap-list text-left mb50">
                                <li class="probootstrap-check">Process 5000 rows of your CSV file.</li>
                                <li class="probootstrap-check">Lorem ipsum dolor sit amet</li>
                                <li class="probootstrap-check">Lorem ipsum dolor sit amet consec tetur adipisicing elit</li>
                                </ul>
                                <p><a href="#" class="btn btn-black">Downgrade</a></p>
                            </div>
                        </div>
            
                        <div class="col-md-4">
                            <div class="probootstrap-pricing probootstrap-popular probootstrap-shadow">
                                <h2>Basic</h2>
                                <p class="probootstrap-price"><strong>$49.99</strong></p>
                                <p class="probootstrap-note">This is a monthly recurring payment.</p>
                                <ul class="probootstrap-list text-left mb50">
                                <li class="probootstrap-check">Process 10000 rows of your CSV file.</li>
                                <li class="probootstrap-check">Lorem ipsum dolor sit amet</li>
                                <li class="probootstrap-check">Lorem ipsum dolor sit amet consec tetur adipisicing elit</li>
                                </ul>
                                <p><a href="#" class="btn btn-primary">Current Plan</a></p>
                            </div>
                        </div>
            
                        <div class="col-md-4">
                            <div class="probootstrap-pricing">
                                <h2>Plus</h2>
                                <p class="probootstrap-price"><strong>$69.99</strong></p>
                                <p class="probootstrap-note">This is a monthly recurring payment.</p>
                                <ul class="probootstrap-list text-left mb50">
                                <li class="probootstrap-check">Process 20000 rows of your CSV file.</li>
                                <li class="probootstrap-check">Lorem ipsum dolor sit amet</li>
                                <li class="probootstrap-check">Lorem ipsum dolor sit amet consec tetur adipisicing elit</li>
                                </ul>
                                <p><a href="#" class="btn btn-black">Upgrade</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="row member-ship-showmore hide">
                        <div class="col-md-4">
                            <div class="probootstrap-pricing">
                                <h2>Buisness</h2>
                                <p class="probootstrap-price"><strong>$89.99</strong></p>
                                <p class="probootstrap-note">This is a monthly recurring payment.</p>
                                <ul class="probootstrap-list text-left mb50">
                                <li class="probootstrap-check">Process 30000 rows of your CSV file.</li>
                                <li class="probootstrap-check">Lorem ipsum dolor sit amet</li>
                                <li class="probootstrap-check">Lorem ipsum dolor sit amet consec tetur adipisicing elit</li>
                                </ul>
                                <p><a href="#" class="btn btn-black">Upgrade</a></p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="probootstrap-pricing">
                                <h2>Premium</h2>
                                <p class="probootstrap-price"><strong>$119.99</strong></p>
                                <p class="probootstrap-note">This is a monthly recurring payment.</p>
                                <ul class="probootstrap-list text-left mb50">
                                <li class="probootstrap-check">Process 50000 rows of your CSV file.</li>
                                <li class="probootstrap-check">Lorem ipsum dolor sit amet</li>
                                <li class="probootstrap-check">Lorem ipsum dolor sit amet consec tetur adipisicing elit</li>
                                </ul>
                                <p><a href="#" class="btn btn-black">Upgrade</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="text-center" id="show-btn-div"><a href="#" id="show-btn">show more</a></div>
                </div>
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
    <script src="{{asset('assets/js/link.js')}}"></script>
    <script src="{{asset('assets/js/user.js')}}"></script>
@endsection