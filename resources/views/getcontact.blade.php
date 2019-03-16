@extends('layout')
@section('styles')

@endsection

@section('content')
<section class="probootstrap-section" id="working-area" data-section="working-area">
    <div class="container">
        @csrf
        <input type="hidden" id="_page" value="main_process" />
        <div class="row justify-content-center text-center mb100">
        <div class="col-md-8 probootstrap-section-heading">
                <div class="form-group color">
                    <h3 class="text-left mytext-dark-blue underline">2. Get contact information</h3>
                    <div class="spinner-border text-primary center" id="dbStore-spinner"></div>
                </div>
                <div class="col-md-12 hide" id="get-contact-info">
                    <div class="row justify-content-center">
                        <div class="col-md-6 col-xs-12">
                            <form action="" class="probootstrap-form pt0" id="process-form">
                                <div class="mb20" id="file_info"></div>

                                <hr />
                                <div class="form-group text-left">
                                    <input type="text" class="form-control" placeholder="Notification email" title="You will receive the notification of completion on this email address.">
                                </div>
                                
                                <div class="right">
                                    <button type="button" id="process-cancel-btn" class="btn btn-lg btn-danger signup-btn mb20">
                                        <span class="btn-label"><i class="fas fa-trash-alt"></i></span>&nbsp;&nbsp;Cancel
                                    </button>
                                    <button type="button" id="process-btn" class="btn btn-lg btn-primary signup-btn mb20">
                                        <span class="btn-label"><i class="fa fa-upload"></i></span>&nbsp;&nbsp;Process
                                    </button>
                                    <button type="button" id="tostep2-btn" class="btn btn-lg btn-success signup-btn mb20 hide">
                                        <span class="btn-label"><i class="fa fa-upload"></i></span>&nbsp;&nbsp;Continue
                                    </button>
                                </div>

                            </form>
                        </div>
                        <div class="col-md-6 col-xs-12">
                            <h4 class="mytext-dark-blue underline">You selected a file. File info is following :</h4>
                            <div class="file-info">
                                <div class="row">
                                    <div class="col-xs-6 text-left">Total rows:</div>
                                    <div class="col-xs-6 text-left total_rows"></div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-6 text-left">Processable rows:</div>
                                    <div class="col-xs-6 text-left processable"></div>
                                </div>
                            </div>
                            <br>
                            <br>
                            <h4 class="mytext-dark-blue underline">If you want to process more rows than your current membership plan, upgrade now!</h4>
                            <button type="button" id="upgrade-membership-btn" class="btn btn-lg btn-primary btn-block signup-btn mb20">
                                <span class="btn-label">Upgrade membership
                            </button>
                        </div>
                    </div>

                </div>
                <div class="col-md-12 hide" id="processing">
                    <h4 class="text-center underline">Processing ...</h4>
                    <h6 class="text-center"> - You will receive the notification of completion on your or given email address. - </h6>
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <button type="button" id="processing-cancel-btn" class="btn btn-lg btn-danger btn-block signup-btn mb20">
                                <span class="btn-label"><i class="fas fa-trash-alt"></i></span>&nbsp;&nbsp;Cancel
                            </button>
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