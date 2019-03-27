@extends('layouts.app')
@section('styles')

@endsection

@section('content')
<section class="probootstrap-section" id="contact-page" data-section="contact">
    <br />
    <div class="container">
        <h3 class="text-black mt0 underline">Get In Touch</h3>
        <div class="row">
            @if (Session::has('success'))
                <div class="col-sm-12 col-xs-12">
                    <div class="alert alert-success text-center">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                        <p>{{Session::get('success')}}</p>
                    </div>
                </div>
            @endif
            <div class="col-md-8 col-xs-12">
            <form action="{{ route('contact.post') }}" method="POST" class="myform form">
                @csrf
                <div class="form-group">
                <input type="text" class="form-control" name="name" placeholder="Your Name" required autofocus>
                </div>
                <div class="form-group">
                <input type="email" class="form-control" name="email" placeholder="Your Email" required>
                </div>
                <div class="form-group">
                <input type="tel" class="form-control" name="phone" placeholder="Your Phone">
                </div>
                <div class="form-group">
                <textarea class="form-control" cols="30" name="message" rows="10" placeholder="Write a Message" required></textarea>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary right" value="Send Message">
                </div>
            </form>
            </div>
            <div class="col-md-4 col-xs-12 col-md-push-1">
                <ul class="probootstrap-contact-details">
                    <li>
                        <span class="text-uppercase mytext-dark-blue">Email:</span>
                        <a href="mailto:admin@admin.com" class="to-email">info@admin.com</a>
                    </li>
                    <li>
                    <span class="text-uppercase mytext-dark-blue">Phone:</span>
                    +30 976 1382 9921
                    </li>
                    <li>
                    <span class="text-uppercase mytext-dark-blue">Fax:</span>
                    +30 976 1382 9922
                    </li>
                    <li>
                    <span class="text-uppercase mytext-dark-blue">Address:</span>
                    San Francisco, CA <br>
                    4th Floor8 Lower <br>
                    San Francisco street, M1 50F
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
    <script src="{{asset('assets/js/link.js')}}"></script>
@endsection