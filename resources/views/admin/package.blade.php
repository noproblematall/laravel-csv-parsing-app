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
        <h1>Package management</h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-user-md"></i> Home</a></li>
            <li class="active">Package management</li>
        </ol>
    </section>
    <section class="content">
        <div class="box box-info">
            <div class="box-header">
                <div class="toolbar">
                    <a href="{{route('admin.preadd_package')}}" class="btn btn-custom" id="make-active">
                        <i class="fa fa-plus"></i>&nbsp;
                        Add New
                    </a>
                    <button class="btn btn-success" id="pk-make-active">
                        <i class="fa fa-unlock"></i>&nbsp;
                        Make Active
                    </button>
                    <button class="btn btn-warning" id="pk-make-inactive">
                        <i class="fa fa-lock"></i>&nbsp;
                        Make Inactive
                    </button>
                    <button class="btn btn-primary" id="pk-edit">
                        <i class="fa fa-edit"></i>&nbsp;
                        Edit
                    </button>
                    <button class="btn btn-danger" id="package-delete">
                        <i class="fa fa-trash-o"></i>&nbsp;
                        Delete
                    </button>
                </div>
                <div class="clear"></div>
            </div>

            <div class="box-body">
                <div class="row mt50 mb50">

                    @foreach($pricings as $pricing)
                    <div class="col-md-2">
                        <div class="probootstrap-pricing">
                            <input type="hidden" name="_id" id="_id" value="{{$pricing->id}}" />
                            <h2>{{$pricing->name}}</h2>
                            <p class="probootstrap-price"><strong>${{$pricing->price}}</strong></p>
                            <p class="probootstrap-note">{{$pricing->description}}</p>
                            <ul class="probootstrap-list text-left mb20">
                                <li class="probootstrap-check">
                                    <i class="fa fa-check"></i>
                                    <span>Process {{$pricing->rows}} rows of your CSV file.</span>
                                </li>
                            </ul>
                            <div class="mb50">
                            <span class="label {{$pricing->active ? 'label-success' : 'label-danger'}}" id="package-active">{{$pricing->active ? 'Active' : 'Inactive'}}</span>
                            </div>
                        </div>
                    </div>
                    @endforeach
        
                </div>
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