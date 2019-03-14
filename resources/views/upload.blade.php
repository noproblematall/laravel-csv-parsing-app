@extends('layout')
@section('styles')

@endsection

@section('content')
<section class="probootstrap-section" id="working-area" data-section="working-area">
    <div class="container">
        <div class="row justify-content-center text-center mb100">
            <div class="col-md-8 probootstrap-section-heading">
                <form method="POST" action="#">
                    @csrf
                    <div class="form-group files color">
                        <h3 class="text-left mytext-dark-blue underline">1. Upload Your File </h3>
                        <div id="resumable-drop" class="hide">
                            <input type="hidden" name="_token" value="{{csrf_token()}}" />
                            <p>
                                <button type="button" name="resumable-browse" class="form-control" data-url="{{ url('upload') }}" id="resumable-browse"></button>
                            </p>
                        </div>
                        <div class="hide mb20" id="progress">
                            <div class="row">
                                <div class="col-md-1 col-sm-1 col-xs-1 text-center">
                                    <i class="fas fa-file" style="margin-top: 20px;"></i>
                                </div>
                                <div class="col-md-9 col-sm-9 col-xs-9">
                                    <p class="text-left"><b id="file-name">&nbsp;</b></p>
                                    <p class="text-left" id="file-size">&nbsp;</p>
                                    <div id="myProgress">
                                        <div class="bar" id="myBar"></div>
                                    </div>
                                </div>
                                <div class="col-md-2 col-sm-2 col-xs-1">
                                    <span id="close">&times;</span>
                                </div>
                            </div>
                        </div>
                        <div class="myalert alert-success alert-dismissible hide" id="success-alert">
                            <a href="#" class="myclose" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Success!</strong> <span>Uploaded Successfully.</span>
                        </div>
                        <br />
                        <div class="myalert alert-danger alert-dismissible hide" id="warning-alert">
                            <a href="#" class="myclose" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Warning!</strong> <span>Please select a file.</span>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-6 col-xs-12">
                            <button type="button" id="upload-btn" class="btn btn-lg btn-primary btn-block signup-btn mb20">
                                <span class="btn-label"><i class="fa fa-upload"></i></span>&nbsp;&nbsp;Upload
                            </button>
                            <button type="button" id="tostep2-btn" class="btn btn-lg btn-success btn-block signup-btn mb20 hide">
                                <span class="btn-label"><i class="fa fa-upload"></i></span>&nbsp;&nbsp;Continue
                            </button>
                            <button type="button" id="cancel-btn" class="btn btn-lg btn-danger btn-block signup-btn mb20">
                                <span class="btn-label"><i class="fas fa-trash-alt"></i></span>&nbsp;&nbsp;Cancel
                            </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
    <script src="{{asset('bower_components/resumablejs/resumable.js')}}" type="application/javascript"></script>
    <script src="{{asset('assets/js/upload.js')}}"></script>
@endsection