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
                    <div class="spinner-border text-primary center hide" id="dbStore-spinner"></div>
                </div>
                <div class="col-md-12" id="get-contact-info">
                    <div class="row">
                        <div class="col-md-6">
                            <form action="" class="probootstrap-form" id="process-form">
                                <div class="form-group text-left">
                                    <label for="total_rows">Total rows:</label>
                                    <input type="text" name="total_rows" id="total_rows" class="form-control" value="5600" placeholder="Total rows" disabled>
                                </div>
                                <div class="form-group text-left">
                                    <label for="rows-to-process">Number of rows to process:</label>
                                    <input type="text" class="form-control" id="rows-to-process" value="5600" placeholder="Number of rows to process" reqired>
                                </div>
                                <div class="form-group text-left">
                                    <input type="text" class="form-control" placeholder="Notification email" title="You will receive the notification of completion on this email address.">
                                </div>
        
                                <button type="button" id="process-btn" class="btn btn-lg btn-primary btn-block signup-btn mb20">
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
                            <h4 class="mytext-dark-blue underline">You selected a file. File info is following :</h4>
                            <div class="file-info">
                                <div class="row">
                                    <div class="col-xs-6 text-left">Total rows:</div>
                                    <div class="col-xs-6 text-left">5600</div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-6 text-left">Processable rows:</div>
                                    <div class="col-xs-6 text-left">10000</div>
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
        </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
    <script src="{{asset('bower_components/resumablejs/resumable.js')}}" type="application/javascript"></script>
    <script src="{{asset('assets/js/upload.js')}}"></script>
@endsection