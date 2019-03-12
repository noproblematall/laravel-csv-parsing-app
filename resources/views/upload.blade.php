@extends('layout')
@section('scripts')

@endsection

@section('content')
<section class="probootstrap-section" id="working-area" data-section="working-area">
    <div class="container">
        <div class="row text-center mb100">
        <div class="col-md-8 col-md-offset-2 probootstrap-section-heading">
            <form method="POST" action="#">
                <div class="form-group files color">
                    <h3>Upload Your File </h3>
                    <input type="file" class="form-control" multiple="">
                </div>
                <div class="col-md-12">
                    <button type="button" class="btn btn-lg btn-primary btn-block signup-btn mb20">
                    <span class="btn-label"><i class="glyphicon glyphicon-ok"></i></span>&nbsp;&nbsp;Upload
                    </button>
                </div>
            </form>
        </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
@endsection