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
        <h1>User management</h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin.home')}}"><i class="fa fa-users"></i> Home</a></li>
            <li class="active">User management</li>
        </ol>
    </section>
    <section class="content">
        <div class="box box-info">
            <div class="box-header">
                <div class="toolbar">
                    <button class="btn btn-success" id="make-active">
                        <i class="fa fa-unlock"></i>&nbsp;
                        Make Active
                    </button>
                    <button class="btn btn-warning" id="make-inactive">
                        <i class="fa fa-lock"></i>&nbsp;
                        Make Inactive
                    </button>
                    <button class="btn btn-primary" id="user-edit">
                        <i class="fa fa-edit"></i>&nbsp;
                        Edit
                    </button>
                    <button class="btn btn-danger" id="user-delete">
                        <i class="fa fa-trash-o"></i>&nbsp;
                        Delete
                    </button>
                </div>
                <div class="clear"></div>
            </div>

            <div class="box-body">
                <table id="user-table" class="table table-bordered table-striped" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th></th>
                            <th>File Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Pacakge</th>
                            <th>Processable</th>
                            <th>Mobile</th>
                            <th>Birthday</th>
                            <th>Location</th>
                            <th>Gender</th>
                            <th>Member since</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </section>
    <div class="alert-area" id="no-selected-alert">
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-ban"></i> Alert!</h4>
            You have to select an at least one item.
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="{{asset('admin_assets/js/user.js')}}"></script>
@endsection