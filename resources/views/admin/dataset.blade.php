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
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-database"></i> Home</a></li>
            <li class="active">Dataset management</li>
        </ol>
    </section>
    <section class="content">
        <div class="box box-info">
            <div class="box-header">
                <div class="toolbar">
                    <a href="{{ route('admin.dataset.add') }}" class="btn btn-custom" id="dataset-add">
                        <i class="fa fa-plus"></i>&nbsp;
                        Add New Dataset
                    </a>
                    <button class="btn btn-primary" id="dataset-edit">
                        <i class="fa fa-edit"></i>&nbsp;
                        Edit
                    </button>
                    <button class="btn btn-success" id="dataset-active">
                        <i class="fa fa-unlock"></i>&nbsp;
                        Make Active
                    </button>
                    <button class="btn btn-warning" id="dataset-inactive">
                        <i class="fa fa-lock"></i>&nbsp;
                        Make Inactive
                    </button>
                    <button class="btn btn-danger" id="dataset-delete">
                        <i class="fa fa-trash-o"></i>&nbsp;
                        Delete
                    </button>
                </div>
                <div class="clear"></div>
            </div>

            <div class="box-body">
                <table id="dataset-table" class="table table-bordered table-striped" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th></th>
                            <th>ID</th>
                            <th>Name</th>
                            <th>First Table</th>
                            <th>First Keyword</th>
                            <th>Second Table</th>
                            <th>Second Keyword</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </section>
</div>
@endsection
@section('scripts')
<script src="{{asset('admin_assets/js/user.js')}}"></script>
@endsection