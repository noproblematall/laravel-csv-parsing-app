@extends('layouts.app')
@section('styles')

@endsection

@section('content')
<section class="probootstrap-section" id="working-area" data-section="working-area">
    <div class="container">
        <div class="row justify-content-center text-center mb100">
            <div class="col-md-8 probootstrap-section-heading">
                <form method="POST" action="#">
                    @csrf
                    <div class="form-group color mb0">
                        <h3 class="text-left mytext-dark-blue underline">1. Upload Your File</h3>
                        <div id="resumable-drop" class="files">
                            @csrf
                            <p>
                                <input type="file" name="resumable-browse" class="form-control" id="resumable-browse" multiple />
                            </p>
                        </div>
                        <div id="progess" class="hide">

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
                    <div class="right">
                        <div class="right">
                            <button type="button" id="cancelAll-btn" class="btn btn-lg btn-danger signup-btn mb20">
                                <span class="btn-label"><i class="fas fa-trash-alt"></i></span>&nbsp;&nbsp;Cancel All
                            </button>
                            <button type="button" id="upload-btn" class="btn btn-lg btn-primary signup-btn mb20 btn-disable">
                                <div class="upload-btn-text">
                                    <span class="btn-label"><i class="fa fa-upload"></i></span>&nbsp;&nbsp;Upload
                                </div>
                                <div class="spinner-border alert-white hide center" id="uploading-spinner"></div>
                            </button>
                            <button type="button" id="tostep2-btn" class="btn btn-lg btn-success signup-btn mb20 hide">
                                <div class="continue-btn-text">&nbsp;&nbsp;Continue</div>
                                <div class="spinner-border alert-white hide center" id="tostep2-spinner"></div>
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