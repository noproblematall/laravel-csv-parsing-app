@extends('layouts.app')
@section('styles')
<link rel="stylesheet" href="{{asset('assets/vendor/dataTables/datatables.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/dataTables/awesome-bootstrap-checkbox.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/dataTables/dataTables.checkboxes.css')}}">
@endsection

@section('content')
<section class="probootstrap-section {{$active}}_area" id="dashboard-area">

<div class="container bootstrap snippet">
    <div class="row">
        <div class="col-sm-3 mobile-hide">
            <div class="text-center" id="brand-img" style="width:202px; height: 202px;">
                
            </div>
            <hr><br>
            <div class="panel panel-default">
                <div class="panel-heading"><strong>Website</strong> <i class="fas fa-link"></i></div>
                <div class="panel-body text-center"><a href="{{asset('/')}}">{{$settings->app_name}}</a></div>
            </div>
            <ul class="list-group mytext-dark-blue">
                <li class="list-group-item text-muted mytext-dark-blue"><strong>Activity</strong> <i class="fas fa-tachometer-alt"></i></li>
                <li class="list-group-item text-right"><span class="pull-left">Current plan</span> {{$current_plan}}</li>
                <li class="list-group-item text-right"><span class="pull-left">Processable rows</span> {{$processable_rows}}</li>
                <li class="list-group-item text-right"><span class="pull-left">Completed Activities</span>{{$completed_files_count}}</li>
                <li class="list-group-item text-right"><span class="pull-left">Activities in process</span>{{$processing_files_count}}</li>
            </ul>
        </div>
        <div class="col-sm-9 col-xs-12" id="dash-right">
            <ul class="nav nav-tabs mobile-hide">
                <li class="{{ $active==='completed' ? 'active' : null }}"><a data-toggle="tab" class="mytext-red" href="#completed">Completed Activities</a></li>
                <li class="{{ $active==='processing' ? 'active' : null }}"><a data-toggle="tab" class="mytext-red" href="#processing">Activities in process</a></li>
                <li class="{{ $active==='info' ? 'active' : null }}"><a data-toggle="tab" class="mytext-red" href="#info">Personal info</a></li>
                <li class="{{ $active==='chang_pwd' ? 'active' : null }}"><a data-toggle="tab" class="mytext-red" href="#chang_pwd">Change password</a></li>
                <li class="{{ $active==='payment' ? 'active' : null }}"><a data-toggle="tab" class="mytext-red" href="#payment">Payment history</a></li>
            </ul>
            @if($active=='completed' || $active=='processing')
            <ul class="nav nav-tabs pc-hide">
                <li class="{{ $active==='completed' ? 'active' : null }}"><a data-toggle="tab" class="mytext-red" href="#completed">Completed</a></li>
                <li class="{{ $active==='processing' ? 'active' : null }}"><a data-toggle="tab" class="mytext-red" href="#processing">Processing</a></li>
            </ul>
            @endif
            @if($active=='payment')
            <ul class="nav nav-tabs pc-hide">
                <li class="{{ $active==='payment' ? 'active' : null }}"><a data-toggle="tab" class="mytext-red" href="#payment">Payment history</a></li>
            </ul>
            @endif
            @if($active=='info')
            <ul class="nav nav-tabs pc-hide">
                <li class="{{ $active==='info' ? 'active' : null }}"><a data-toggle="tab" class="mytext-red" href="#info">Personal info</a></li>
            </ul>
            @endif
            @if($active=='chang_pwd')
            <ul class="nav nav-tabs pc-hide">
                <li class="{{ $active==='chang_pwd' ? 'active' : null }}"><a data-toggle="tab" class="mytext-red" href="#chang_pwd">Change password</a></li>
            </ul>
            @endif

            <div class="tab-content">

                <div class="tab-pane mytext-dark-blue {{ $active==='completed' ? 'active' : null }}" id="completed">
                    <hr>
                    <table id="completed-list-table" class="table table-bordered table-striped" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th></th>        
                                <th>File Name</th>
                                <th>Processed rows</th>
                                <th>Dataset</th>
                                <th>Completed date</th>
                                <th>Result</th>
                                <th>Report</th>
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

                <div class="tab-pane mytext-dark-blue {{ $active==='processing' ? 'active' : null }}" id="processing">
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

                <div class="tab-pane info_tab mytext-dark-blue {{ $active==='info' ? 'active' : null }}" id="info">
                    <hr>
                    <form class="form myform" action="{{ route('user.personal_info.post') }}" method="post" id="registrationForm">
                        @csrf
                        <div class="form-group">

                            <div class="col-sm-6 col-xs-12">
                                <label for="first_name">
                                    <h4 class="mb10">First name</h4>
                                </label>
                                <input type="text" class="form-control" name="first_name" id="first_name"
                                    placeholder="first name" value="{{$user->f_name}}" title="enter your first name if any.">
                            </div>
                        </div>
                        <div class="form-group">

                            <div class="col-sm-6 col-xs-12">
                                <label for="last_name">
                                    <h4 class="mb10">Last name</h4>
                                </label>
                                <input type="text" class="form-control" name="last_name" id="last_name"
                                    placeholder="last name" value="{{$user->l_name}}" title="enter your last name if any.">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-6 col-xs-12">
                                <label for="email">
                                    <h4 class="mb10">Email</h4>
                                </label>
                                <input type="email" class="form-control" name="email" id="p_email"
                                    placeholder="you@email.com" value="{{$user->email}}" disabled title="enter your email.">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-6 col-xs-12">
                                <label for="mobile">
                                    <h4 class="mb10">Birthday</h4>
                                </label>
                                <div class="row">
                                    <div class="col-xs-4 col-md-4">
                                      <select name="month" class="form-control input-lg">
                                            <option value="">Month</option>
                                        @if($birth[0] == '01')                                        
                                            <option value="01" selected>Jan</option>
                                        @else
                                            <option value="01">Jan</option>
                                        @endif
                                        @if($birth[0] == '02')                                        
                                            <option value="02" selected>Feb</option>
                                        @else
                                            <option value="02">Feb</option>
                                        @endif
                                        @if($birth[0] == '03')                                        
                                            <option value="03" selected>Mar</option>
                                        @else
                                            <option value="01">Mar</option>
                                        @endif
                                        @if($birth[0] == '04')
                                            <option value="04" selected>Apr</option>
                                        @else
                                            <option value="04">Apr</option>
                                        @endif
                                        @if($birth[0] == '05')
                                            <option value="05" selected>May</option>
                                        @else
                                            <option value="05">May</option>
                                        @endif
                                        @if($birth[0] == '06')
                                            <option value="06" selected>Jun</option>
                                        @else
                                            <option value="06">Jun</option>
                                        @endif
                                        @if($birth[0] == '07')
                                            <option value="07" selected>Jul</option>
                                        @else
                                            <option value="07">Jul</option>
                                        @endif
                                        @if($birth[0] == '08')
                                            <option value="08" selected>Aug</option>
                                        @else
                                            <option value="08">Aug</option>
                                        @endif
                                        @if($birth[0] == '09')
                                            <option value="09" selected>Sep</option>
                                        @else
                                            <option value="09">Sep</option>
                                        @endif
                                        @if($birth[0] == '10')
                                            <option value="10" selected>Oct</option>
                                        @else
                                            <option value="10">Oct</option>
                                        @endif
                                        @if($birth[0] == '11')
                                            <option value="11" selected>Nov</option>
                                        @else
                                            <option value="11">Nov</option>
                                        @endif
                                        @if($birth[0] == '12')
                                            <option value="12" selected>Dec</option>
                                        @else
                                            <option value="12">Dec</option>
                                        @endif
                                      </select>
                                    </div>
                                    <div class="col-xs-4 col-md-4">
                                      <select name="day" class="form-control input-lg">
                                        <option value="">Day</option>
                                        @for($i=1;$i<=31;$i++)
                                            @if($birth[1] == $i || $birth[1] == '0'.$i)
                                                <option value="{{$i}}" selected>{{$i}}</option>
                                            @else
                                                <option value="{{$i}}">{{$i}}</option>
                                            @endif
                                        @endfor
                                      </select>
                                    </div>
                                    <div class="col-xs-4 col-md-4">
                                      <select name="year" class="form-control input-lg">
                                        <option value="">Year</option>
                                        @for($i=1950; $i < 2019; $i++)
                                            @if($birth[2] == $i)
                                                <option value="{{$i}}" selected>{{$i}}</option>
                                            @else
                                                <option value="{{$i}}">{{$i}}</option>
                                            @endif
                                        @endfor
                                      </select>
                                    </div>
                                  </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-6 col-xs-12">
                                <label for="mobile">
                                    <h4 class="mb10">Mobile</h4>
                                </label>
                                <input type="text" class="form-control" name="mobile" id="mobile"
                                    placeholder="enter mobile number" value="{{$user->mobile}}" title="enter your mobile number if any.">
                            </div>
                        </div>
                        <div class="form-group">

                            <div class="col-sm-6 col-xs-12">
                                <label for="location">
                                    <h4 class="mb10">Location</h4>
                                </label>
                                <input type="text" class="form-control" name="location" id="location" placeholder="somewhere" value="{{$user->location}}"
                                    title="enter a location">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12 col-xs-12">
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

                <div class="tab-pane mytext-dark-blue {{ $active==='chang_pwd' ? 'active' : null }}" id="chang_pwd">
                    <hr>
                    <form class="form myform" action="{{ route('user.change_pwd.post') }}" method="post" id="change_pwd_form">
                        @csrf
                        @if (Session::has('success'))
                        <div class="form-group">
                            <div class="col-sm-12 col-xs-12">
                                <div class="alert alert-success text-center">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                    <p>{{ Session::get('success') }}</p>
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="form-group">
                            <div class="col-sm-6 col-xs-12">
                                <label for="password">
                                    <h4 class="mb10">Password</h4>
                                </label>
                                <input type="password" class="form-control" name="password" id="p_password"
                                    placeholder="password" title="enter your password." required autofocus />
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-6 col-xs-12">
                                <label for="password2">
                                    <h4 class="mb10">Verify</h4>
                                </label>
                                <input type="password" class="form-control" name="password_confirmation" id="password2"
                                    placeholder="confirm password" title="Confirm password." required>
                            </div>
                        </div>
                        @if ($errors->any())
                        <div class="form-group">
                            <div class="col-sm-12 col-xs-12">
                                <div class="alert alert-danger">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="form-group">
                            <div class="col-sm-12 col-xs-12">
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

                <div class="tab-pane mytext-dark-blue {{ $active==='payment' ? 'active' : null }}" id="payment">
                    <hr>
                    <table id="payment-history-table" class="table table-bordered table-striped" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Date</th>
                                <th>Transaction</th>
                                <th>Currency</th>
                                <th>Amount</th>
                                <th>PDF</th>
                            </tr>
                        </thead>
                    </table>
                    
                    <table id="mobile-payment-history-table" class="table table-bordered table-striped" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Transaction</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
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