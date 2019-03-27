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
        <div class="row justify-content-center text-center">
            <div class="col-md-8">
                <h2 class="mb30 text-black title">Choose the plan that’s right for your business </h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna
                    aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                </p>
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
</section>
@endsection

@section('scripts')
    <script src="{{asset('assets/js/link.js')}}"></script>
@endsection