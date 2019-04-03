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
        <h1>Dataset management</h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-database"></i> Home</a></li>
            <li class="active">Dataset management</li>
        </ol>
    </section>
    <section class="content">
        <div class="box box-info">
            <div class="box-header">
                <div class="toolbar">
                    <button class="btn btn-success" id="make-active">Make Active</button>
                    <button class="btn btn-warning" id="make-inactive">Make Inactive</button>
                    <button class="btn btn-danger" id="user-delete">Delete</button>
                </div>
                <div class="clear"></div>
            </div>

            <div class="box-body">

            </div>
        </div>
    </section>
</div>
@endsection
@section('scripts')
<script src="{{asset('admin_assets/js/user.js')}}"></script>
@endsection