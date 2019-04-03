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
        <h1>Settings Management</h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-gears"></i> Home</a></li>
            <li class="active">Settings Management</li>
        </ol>
    </section>
    <section class="content">
        <div class="box box-info">
            <div class="box-header">
                <h4>Edit Settings</h4>
            </div>

            <div class="box-body">
                <div class="row">
                    <div class="col-md-12 col-xs-12">
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li class="{{ $tab==='seo' ? 'active' : null }}"><a href="#seo" data-toggle="tab">SEO Settings</a></li>
                                <li class="{{ $tab==='contact' ? 'active' : null }}"><a href="#contact" data-toggle="tab">Contact Settings</a></li>
                                <li class="{{ $tab==='other' ? 'active' : null }}"><a href="#other" data-toggle="tab">Other Settings</a></li>
                                <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane {{ $tab==='seo' ? 'active' : null }}" id="seo">
                                    @if ($errors->any())
                                    <div class="form-group row">
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
                                    <form action="{{ route('admin.seo') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <br />
                                        <div class="row">
                                            <div class="col-md-1 text-right"><b>Site Logo</b></div>
                                            <div class="col-md-11">
                                                <input type="file" class="form-control" name="logo" id="logo" />
                                            </div>
                                        </div>
                                        <br />
                                        <div class="row">
                                            <div class="col-md-1 text-right"><b>Fav Icon</b></div>
                                            <div class="col-md-11">
                                                <input type="file" class="form-control" name="fav" id="fav" />
                                            </div>
                                        </div>
                                        <br />
                                        <div class="row">
                                            <div class="col-md-1 text-right"><b>App Name</b></div>
                                            <div class="col-md-11">
                                                <input type="text" class="form-control" name="app_name" id="app_name" value="{{$settings->app_name}}" placeholder="App Name" />
                                            </div>
                                        </div>
                                        <br />
                                        <div class="row">
                                            <div class="col-md-1 text-right"><b>Meta Title</b></div>
                                            <div class="col-md-11">
                                                <input type="text" class="form-control" name="meta_title" id="meta_title" value="{{$settings->meta_title}}" placeholder="Meta Title" />
                                            </div>
                                        </div>
                                        <br />
                                        <div class="row">
                                            <div class="col-md-1 text-right"><b>Meta Keyawords</b></div>
                                            <div class="col-md-11">
                                                <p>( * Please enter each item separated by a commas. )</p>
                                                <textarea type="text" class="form-control" name="meta_key" id="meta_key" placeholder="Meta Keyawords">{{$settings->meta_keywords}}</textarea>
                                            </div>
                                        </div>
                                        <br />
                                        <div class="row">
                                            <div class="col-md-1 text-right"><b>Meta Description</b></div>
                                            <div class="col-md-11">
                                                <textarea type="text" class="form-control" name="meta_des" id="meta_des" placeholder="Meta Description">{{$settings->meta_description}}</textarea>
                                            </div>
                                        </div>
                                        <br />
                                        <div class="row">
                                            <div class="col-md-1 text-right"><b>Google analytics code</b></div>
                                            <div class="col-md-11">
                                                <textarea type="text" class="form-control" name="google_analytics" id="google_analytics" placeholder="Meta Description">{{$settings->google_analytics}}</textarea>
                                            </div>
                                        </div>
                                        <br />
                                        <hr />
                                        <div class="row">
                                            <div class="col-md-1"></div>
                                            <div class="col-md-11">
                                                <button class="btn btn-custom btn-square pull-left btn-lg">&nbsp;&nbsp;Save&nbsp;&nbsp;</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="tab-pane {{ $tab==='contact' ? 'active' : null }}" id="contact">
                                    <form action="{{ route('admin.contact') }}" method="post">
                                        @csrf
                                        <br />
                                        <div class="row">
                                            <div class="col-md-1 text-right"><b>Email</b></div>
                                            <div class="col-md-11">
                                                <input type="email" class="form-control" name="email" id="email" value="{{$settings->email}}" placeholder="Email" />
                                            </div>
                                        </div>
                                        <br />
                                        <div class="row">
                                            <div class="col-md-1 text-right"><b>Phone</b></div>
                                            <div class="col-md-11">
                                                <input type="text" class="form-control" name="phone" id="phone" value="{{$settings->phone}}" placeholder="Phone" />
                                            </div>
                                        </div>
                                        <br />
                                        <div class="row">
                                            <div class="col-md-1 text-right"><b>Fax</b></div>
                                            <div class="col-md-11">
                                                <input type="text" class="form-control" name="fax" id="fax" value="{{$settings->fax}}" placeholder="Fax" />
                                            </div>
                                        </div>
                                        <br />
                                        <div class="row">
                                            <div class="col-md-1 text-right"><b>Address</b></div>
                                            <div class="col-md-11">
                                                <textarea type="text" class="form-control" name="address" id="address" rows=3 placeholder="Address">{{$settings->address}}</textarea>
                                            </div>
                                        </div>
                                        <br />
                                        <hr />
                                        <div class="row">
                                            <div class="col-md-1"></div>
                                            <div class="col-md-11">
                                                <button class="btn btn-custom btn-square pull-left btn-lg">&nbsp;&nbsp;Save&nbsp;&nbsp;</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="tab-pane {{ $tab==='other' ? 'active' : null }}" id="other">
                                    <form action="{{ route('admin.other') }}" method="post">
                                        @csrf
                                        <br />
                                        <div class="row">
                                            <div class="col-md-2 text-right"><b>Banner Text</b></div>
                                            <div class="col-md-10">
                                                <textarea type="text" class="form-control" name="banner" id="banner" placeholder="Banner Text">{{$settings->banner_text}}</textarea>
                                            </div>
                                        </div>
                                        <br />
                                        <div class="row">
                                            <div class="col-md-2 text-right"><b>Package Page Title</b></div>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" name="pk_title" id="pk_title" value="{{$settings->pk_title}}" placeholder="Package Page Title" />
                                            </div>
                                        </div>
                                        <br />
                                        <div class="row">
                                            <div class="col-md-2 text-right"><b>Package Page Text</b></div>
                                            <div class="col-md-10">
                                                <textarea type="text" class="form-control" name="pk_text" id="pk_text" placeholder="Package Page Text">{{$settings->pk_text}}</textarea>
                                            </div>
                                        </div>
                                        <br />
                                        <div class="row">
                                            <div class="col-md-2 text-right"><b>Middle Section Title</b></div>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" name="md_title" id="md_title" value="{{$settings->md_title}}" placeholder="Middle Section Title" />
                                            </div>
                                        </div>
                                        <br />
                                        <div class="row">
                                            <div class="col-md-2 text-right"><b>Middle Section Text</b></div>
                                            <div class="col-md-10">
                                                <textarea type="text" class="form-control" name="md_text" id="md_text" placeholder="Middle Section Text">{{$settings->md_text}}</textarea>
                                            </div>
                                        </div>
                                        <br />
                                        <div class="row">
                                            <div class="col-md-2 text-right"><b>Footer Text</b></div>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" name="ft_text" id="ft_text" value="{{$settings->foot_text}}" placeholder="Footer Text" />
                                            </div>
                                        </div>
                                        <br />
                                        <hr />
                                        <div class="row">
                                            <div class="col-md-2"></div>
                                            <div class="col-md-10">
                                                <button class="btn btn-custom btn-square pull-left btn-lg">&nbsp;&nbsp;Save&nbsp;&nbsp;</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
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