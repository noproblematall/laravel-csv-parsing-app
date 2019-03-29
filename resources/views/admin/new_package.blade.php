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
        <h1>Add New Package</h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-user-md"></i> Home</a></li>
            <li><a href="{{route('admin.package')}}">Package management</a></li>
            <li class="active">Add New Package</li>
        </ol>
    </section>
    <section class="content">
        <div class="box box-info">
            <div class="box-header">
                <div class="toolbar">
                    <a href="{{route('admin.package')}}" class="btn btn-custom" id="make-active">
                        <i class="fa fa-hand-scissors-o"></i>&nbsp;
                        Back
                    </a>
                </div>
                <div class="clear"></div>
            </div>

            <div class="box-body">
                <div class="row mb50">
                    <div class="col-sm-6">
                        <form id="new_package_form" action="{{route('admin.add_package')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="name">Title</label>
                                <input type="text" name="title" class="form-control" required autofocus />
                            </div>
                            <div class="form-group">
                                <label for="name">Price</label>
                                <input type="number" name="price" class="form-control" required />
                            </div>
                            <div class="form-group">
                                <label for="name">Rows</label>
                                <input type="number" name="rows" class="form-control" required />
                            </div>
                            <div class="form-group">
                                <label for="name">Description</label>
                                <input type="text" name="description" class="form-control" required />
                            </div>
                            <div class="form-group">
                                <label for="name">Active</label>
                                <select name="active" class="form-control" id="active" required>
                                    <option value="1">active</option>
                                    <option value="0">inactive</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-custom btn-square pull-right btn-lg">&nbsp;&nbsp;Save&nbsp;&nbsp;</button>
                                <button class="btn btn-default btn-square pull-right btn-lg" type="reset">Reset</button>
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