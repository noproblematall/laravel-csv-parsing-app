@extends('layouts.admin')
@section('styles')
<link rel="stylesheet" href="{{asset('assets/vendor/dataTables/datatables.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/dataTables/awesome-bootstrap-checkbox.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/dataTables/dataTables.checkboxes.css')}}">
@endsection
@section('content')
<div class="content-wrapper">
@csrf
    <section class="content-header">
        <h1>Edit New User</h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-user-md"></i> Home</a></li>
            <li><a href="{{route('admin.package')}}">User management</a></li>
            <li class="active">Edit User</li>
        </ol>
    </section>
    <section class="content">
        <div class="box box-info">
            <div class="box-header">
                <div class="toolbar">
                    <a href="{{route('admin.user')}}" class="btn btn-custom" id="make-active">
                        <i class="fa fa-hand-scissors-o"></i>&nbsp;
                        Back
                    </a>
                </div>
                <div class="clear"></div>
            </div>

            <div class="box-body">
                <div class="row mb50">
                    <div class="col-sm-12 col-xs-12">
                        <form class="form myform" action="{{ route('admin.user.edit') }}" method="post" id="user-edit-form">
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
                                        placeholder="you@email.com" value="{{$user->email}}" readonly title="enter your email.">
                                </div>
                            </div>
    
                            <div class="form-group">
                                <div class="col-sm-6 col-xs-12">
                                    <label for="mobile">
                                        <h4 class="mb10">Birthday</h4>
                                    </label>
                                    <input type="text" class="form-control" name="birth" id="birth"
                                        placeholder="enter mobile number" value="{{$user->birthday}}" title="enter your birthday if any.">
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
                                <div class="col-sm-6 col-xs-12">
                                    <label for="package">
                                        <h4 class="mb10">Package</h4>
                                    </label>
                                    <select class="form-control" name="package" id="package">
                                        <option value="">Select a package</option>
                                        @foreach($packages as $pk)
                                            @if($user->package)
                                                @if($user->package->id == $pk->id)
                                                    <option value="{{$pk->id}}" selected>{{strtoupper($pk->name)}}</option>
                                                @else
                                                    <option value="{{$pk->id}}">{{strtoupper($pk->name)}}</option>
                                                @endif
                                            @else
                                                <option value="{{$pk->id}}">{{strtoupper($pk->name)}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-6 col-xs-12">
                                    <label for="processed">
                                        <h4 class="mb10">Processed number of rows</h4>
                                    </label>
                                    <input type="number" class="form-control" name="processed" id="processed" placeholder="Number of processed rows" value="{{$user->processed}}" title="enter a processed number of rows" />
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12 col-xs-12">
                                    <br>
                                    <div class="right" style="display: inline-block">
                                        <button class="btn btn-custom btn-square pull-right btn-lg">&nbsp;&nbsp;Save&nbsp;&nbsp;</button>
                                        <button class="btn btn-default btn-square pull-right btn-lg" type="reset">Reset</button>
                                    </div>
                                    <div class="clear"></div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
@section('scripts')
<script src="{{asset('admin_assets/js/user.js')}}"></script>
@endsection