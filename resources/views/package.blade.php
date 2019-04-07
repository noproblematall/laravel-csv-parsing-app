@extends('layouts.app')
@section('styles')

@endsection

@section('content')
<section class="probootstrap-section" id="package-page" data-section="package">
    <br />
    <div class="container">
        @if (Session::has('success'))
        <div class="alert alert-success text-center">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            <p>{{ Session::get('success') }}</p>
        </div>
        @endif
        @if (Session::has('error'))
        <div class="alert alert-warning text-center">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            <p>{{ Session::get('error') }}</p>
        </div>
        @endif
        <div class="row justify-content-center text-center">
            <div class="col-md-8">
                <h2 class="mb30 text-black title">{!!$settings->pk_title!!}</h2>
                <p>{!!$settings->pk_text!!}</p>
            </div>
        </div>
        <!-- END row -->
        <div class="row justify-content-center">

            @foreach($pricings as $pricing)
            <div class="col-md-4">
                <div class="probootstrap-pricing">
                    <form action="{{ route('get_stripe_form') }}" method="post">
                        @csrf
                        <input type="hidden" name="_id" value="{{$pricing->id}}" />
                        <h2>{{$pricing->name}}</h2>
                        <p class="probootstrap-price"><strong>${{$pricing->price}}</strong></p>
                        <p class="probootstrap-note">{{$pricing->description}}</p>
                        <ul class="probootstrap-list text-left mb50">
                            <li class="probootstrap-check">Process {{$pricing->rows}} rows of your CSV file.</li>
                        </ul>
                        <p><button class="btn {{ $pricing->id === 2 ? 'btn-primary' : 'btn-black' }}">Get Started</button></p>
                    </form>
                </div>
            </div>
            @endforeach

        </div>
    </div>
@if(Session::has('verified'))
    <div class="modal fade" id="verified" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title mytext-dark-blue">Verified</h4>
            </div>
            <div class="modal-body">
                <br />
                <p class="mytext-dark-blue">Your email address is verified successfully!</p>
            </div>
            <div class="modal-footer">
                <a href="{{route('user.dashboard')}}" class="btn btn-primary">Go to dashboard</a>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
    </div>
@endif
</section>

@endsection

@section('scripts')
    <script src="{{asset('assets/js/link.js')}}"></script>
@endsection