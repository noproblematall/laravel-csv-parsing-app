@extends('layout')
@section('styles')

@endsection

@section('content')
<section class="probootstrap-section" id="working-area" data-section="working-area">
    <div class="container">
        <div class="row justify-content-center text-center mb100">
        <div class="col-md-8 probootstrap-section-heading">
                <div class="form-group color">
                    <h3 class="text-left mytext-dark-blue underline">2. Get contact information</h3>
                    <div class="spinner-border text-primary center" id="dbStore-spinner"></div>
                </div>
                <div class="col-md-12" id="get-contact-info">
                    <div class="row">
                        <div class="col-md-6">
                            <form action="" class="probootstrap-form" id="process-form">
                                <div class="form-group">
                                    <input type="email" class="form-control" placeholder="Your Email">
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control" placeholder="Your Email">
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control" placeholder="Your Email">
                                </div>
        
                                <button type="button" id="upload-btn" class="btn btn-lg btn-primary btn-block signup-btn mb20">
                                    <span class="btn-label"><i class="fa fa-upload"></i></span>&nbsp;&nbsp;Process
                                </button>
                                <button type="button" id="tostep2-btn" class="btn btn-lg btn-success btn-block signup-btn mb20 hide">
                                    <span class="btn-label"><i class="fa fa-upload"></i></span>&nbsp;&nbsp;Continue
                                </button>
                                <button type="button" id="cancel-btn" class="btn btn-lg btn-danger btn-block signup-btn mb20">
                                    <span class="btn-label"><i class="fas fa-trash-alt"></i></span>&nbsp;&nbsp;Cancel
                                </button>
                            </form>
                        </div>
                        <div class="col-md-6">
                            <h4 class="mytext-dark-blue">You selected a file. File info is following :</h4>
                        </div>
                    </div>

                </div>
        </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
    <script src="{{asset('bower_components/resumablejs/resumable.js')}}" type="application/javascript"></script>
    <script src="{{asset('assets/js/upload.js')}}"></script>
@endsection