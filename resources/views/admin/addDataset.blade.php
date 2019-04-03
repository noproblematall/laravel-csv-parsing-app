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
        <h1>Add New Dataset</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-database"></i> Home</a></li>
            <li class="active">Dataset management</li>
        </ol>
    </section>
    <section class="content">
        <div class="box box-info">
            <div class="box-header">
                <div class="toolbar">
                    <a href="{{ route('admin.dataset') }}" class="btn btn-custom" id="dataset-add">
                        <i class="fa fa-hand-scissors-o"></i>&nbsp;
                        Back
                    </a>
                </div>
                <div class="clear"></div>
            </div>

            <div class="box-body">
                <form action="{{ route('admin.dataset.add.post') }}" method="POST" id="add-dataset-form">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Name</label>
                                <input type="text" id="name" name="name" class="form-control" required />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">First table name</label>
                                <select name="first_table" id="first_table" class="form-control" required>
                                    <option value="">Select first table</option>
                                    @foreach($tables as $table)
                                        <option value="{{$table}}">{{$table}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">First table keyword</label>
                                <select name="first_table_keyword" id="first_table_keyword" class="form-control" required>
                                    <option value="">Select keyword of first table</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Second table name</label>
                                <select name="second_table" id="second_table" class="form-control" required>
                                    <option value="">Select second table</option>
                                    @foreach($tables as $table)
                                        <option value="{{$table}}">{{$table}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Second table keyword</label>
                                <select name="second_table_keyword" id="second_table_keyword" class="form-control" required>
                                    <option value="">Select keyword of second table</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Active</label>
                                <select name="active" id="active" class="form-control" required>
                                    <option value=""></option>
                                    <option value="1">active</option>
                                    <option value="0">inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group pull-right">
                        <button class="btn btn-custom btn-square pull-right btn-lg">&nbsp;&nbsp;Save&nbsp;&nbsp;</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection
@section('scripts')
<script src="{{asset('admin_assets/js/user.js')}}"></script>
@endsection