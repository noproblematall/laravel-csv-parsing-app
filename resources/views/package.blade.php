@extends('layouts.app')
@section('styles')

@endsection

@section('content')
<section class="probootstrap-section" id="package-page" data-section="package">
    <br />
    <div class="container">
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

        <div class="col-md-4">
            <div class="probootstrap-pricing">
                <h2>Starter</h2>
                <p class="probootstrap-price"><strong>$22.99</strong></p>
                <p class="probootstrap-note">This is a monthly recurring payment.</p>
                <ul class="probootstrap-list text-left mb50">
                <li class="probootstrap-check">Process 5000 rows of your CSV file.</li>
                <li class="probootstrap-check">Lorem ipsum dolor sit amet</li>
                <li class="probootstrap-check">Lorem ipsum dolor sit amet consec tetur adipisicing elit</li>
                </ul>
                <p><a href="#" class="btn btn-black">Get Started</a></p>
            </div>
            </div>

            <div class="col-md-4">
            <div class="probootstrap-pricing probootstrap-popular probootstrap-shadow">
                <h2>Basic</h2>
                <p class="probootstrap-price"><strong>$49.99</strong></p>
                <p class="probootstrap-note">This is a monthly recurring payment.</p>
                <ul class="probootstrap-list text-left mb50">
                <li class="probootstrap-check">Process 10000 rows of your CSV file.</li>
                <li class="probootstrap-check">Lorem ipsum dolor sit amet</li>
                <li class="probootstrap-check">Lorem ipsum dolor sit amet consec tetur adipisicing elit</li>
                </ul>
                <p><a href="#" class="btn btn-primary">Get Started</a></p>
            </div>
            </div>

            <div class="col-md-4">
            <div class="probootstrap-pricing">
                <h2>Plus</h2>
                <p class="probootstrap-price"><strong>$69.99</strong></p>
                <p class="probootstrap-note">This is a monthly recurring payment.</p>
                <ul class="probootstrap-list text-left mb50">
                <li class="probootstrap-check">Process 20000 rows of your CSV file.</li>
                <li class="probootstrap-check">Lorem ipsum dolor sit amet</li>
                <li class="probootstrap-check">Lorem ipsum dolor sit amet consec tetur adipisicing elit</li>
                </ul>
                <p><a href="#" class="btn btn-black">Get Started</a></p>
            </div>
            </div>

            <div class="col-md-4">
            <div class="probootstrap-pricing">
                <h2>Buisness</h2>
                <p class="probootstrap-price"><strong>$89.99</strong></p>
                <p class="probootstrap-note">This is a monthly recurring payment.</p>
                <ul class="probootstrap-list text-left mb50">
                <li class="probootstrap-check">Process 30000 rows of your CSV file.</li>
                <li class="probootstrap-check">Lorem ipsum dolor sit amet</li>
                <li class="probootstrap-check">Lorem ipsum dolor sit amet consec tetur adipisicing elit</li>
                </ul>
                <p><a href="#" class="btn btn-black">Get Started</a></p>
            </div>
            </div>

            <div class="col-md-4">
            <div class="probootstrap-pricing">
                <h2>Premium</h2>
                <p class="probootstrap-price"><strong>$119.99</strong></p>
                <p class="probootstrap-note">This is a monthly recurring payment.</p>
                <ul class="probootstrap-list text-left mb50">
                <li class="probootstrap-check">Process 50000 rows of your CSV file.</li>
                <li class="probootstrap-check">Lorem ipsum dolor sit amet</li>
                <li class="probootstrap-check">Lorem ipsum dolor sit amet consec tetur adipisicing elit</li>
                </ul>
                <p><a href="#" class="btn btn-black">Get Started</a></p>
            </div>
            </div>

        </div>
    </div>
</section>
@endsection

@section('scripts')
    <script src="{{asset('assets/js/link.js')}}"></script>
@endsection