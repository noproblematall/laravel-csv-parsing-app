@extends('layouts.app')
@section('styles')

@endsection

@section('content')
<section class="probootstrap-hero prohttp://localhost/probootstrap/frame/#featuresbootstrap-slant"
style="background-image: url(./assets/img/image_1.jpg);" data-section="home" data-stellar-background-ratio="0.5">
<div class="container">
  <div class="row intro-text">
    <div class="col-md-8 col-md-offset-2 text-center">
      <h1 class="probootstrap-heading probootstrap-animate">Lorem ipsum dolor sit amet, consectetuer adipiscing elit
      </h1>
      @guest
      <div class="probootstrap-subheading center">
        <p class="probootstrap-animate"><a href="{{ route('register') }}" role="button"
        class="btn btn-primary">Get Started</a></p>
      </div>
      @else
      <div class="probootstrap-subheading center">
        <p class="probootstrap-animate"><a href="{{ route('working_area') }}" role="button"
        class="btn btn-primary">Get Started</a></p>
      </div>
      @endguest
    </div>
  </div>
</div>
</section>

<section class="probootstrap-section" data-section="pricing">
<div class="container">
  <div class="row text-center mb100">
    <div class="col-md-8 col-md-offset-2 probootstrap-section-heading">
      <h2 class="mb30 text-black probootstrap-heading">Choose the plan that’s right for your business </h2>
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
<!-- END section -->

<section class="probootstrap-section probootstrap-bg-light" data-section="reviews">
<div class="container">
  <div class="row text-center mb100">
    <div class="col-md-8 col-md-offset-2 probootstrap-section-heading">
      <h2 class="mb30 text-black probootstrap-heading">That’s why 100,000+ Love Frame</h2>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna
        aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
      </p>
    </div>
  </div>
  <!-- END row -->
  <div class="row">
    <div class="col-md-4 col-sm-6 col-xs-12">
      <div class="probootstrap-testimonial">
      <p><img src="{{ asset('assets/img/person_1.jpg') }}" class="img-responsive img-circle probootstrap-author-photo" alt="Image"></p>
        <p class="mb10 probootstrap-rate">
          <i class="icon-star"></i>
          <i class="icon-star"></i>
          <i class="icon-star"></i>
          <i class="icon-star"></i>
          <i class="icon-star"></i>
        </p>
        <blockquote>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna
            aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
          </p>
        </blockquote>
        <p class="mb0">&mdash; Garry Alexander</p>
      </div>
    </div>
    <div class="col-md-4 col-sm-6 col-xs-12">
      <div class="probootstrap-testimonial">
        <p><img src="{{ asset('assets/img/person_2.jpg') }}" class="img-responsive img-circle probootstrap-author-photo" alt="Image"></p>
        <p class="mb10 probootstrap-rate">
          <i class="icon-star"></i>
          <i class="icon-star"></i>
          <i class="icon-star"></i>
          <i class="icon-star"></i>
          <i class="icon-star"></i>
        </p>
        <blockquote>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna
            aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
          </p>
        </blockquote>
        <p class="mb0">&mdash; James Robertson</p>
      </div>
    </div>
    <div class="clearfix visible-sm-block"></div>
    <div class="col-md-4 col-sm-6 col-xs-12">
      <div class="probootstrap-testimonial">
        <p><img src="{{ asset('assets/img/person_3.jpg') }}" class="img-responsive img-circle probootstrap-author-photo" alt="Image"></p>
        <p class="mb10 probootstrap-rate">
          <i class="icon-star"></i>
          <i class="icon-star"></i>
          <i class="icon-star"></i>
          <i class="icon-star"></i>
          <i class="icon-star"></i>
        </p>
        <blockquote>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna
            aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
          </p>
        </blockquote>
        <p class="mb0">&mdash; Ben Goodrich</p>
      </div>
    </div>
    <div class="col-md-4 col-sm-6 col-xs-12">
      <div class="probootstrap-testimonial">
        <p><img src="{{ asset('assets/img/person_4.jpg') }}" class="img-responsive img-circle probootstrap-author-photo" alt="Image"></p>
        <p class="mb10 probootstrap-rate">
          <i class="icon-star"></i>
          <i class="icon-star"></i>
          <i class="icon-star"></i>
          <i class="icon-star"></i>
          <i class="icon-star-outlined"></i>
        </p>
        <blockquote>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna
            aliqua.</p>
        </blockquote>
        <p class="mb0">&mdash; Kip Hugh</p>
      </div>
    </div>
    <div class="clearfix visible-sm-block"></div>
    <div class="col-md-4 col-sm-6 col-xs-12">
      <div class="probootstrap-testimonial">
        <p><img src="{{ asset('assets/img/person_2.jpg') }}" class="img-responsive img-circle probootstrap-author-photo" alt="Image"></p>
        <p class="mb10 probootstrap-rate">
          <i class="icon-star"></i>
          <i class="icon-star"></i>
          <i class="icon-star"></i>
          <i class="icon-star"></i>
          <i class="icon-star"></i>
        </p>
        <blockquote>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna
            aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
          </p>
        </blockquote>
        <p class="mb0">&mdash; James Robertson</p>
      </div>
    </div>
    <div class="col-md-4 col-sm-6 col-xs-12">
      <div class="probootstrap-testimonial">
        <p><img src="{{ asset('assets/img/person_3.jpg') }}" class="img-responsive img-circle probootstrap-author-photo" alt="Image"></p>
        <p class="mb10 probootstrap-rate">
          <i class="icon-star"></i>
          <i class="icon-star"></i>
          <i class="icon-star"></i>
          <i class="icon-star"></i>
          <i class="icon-star"></i>
        </p>
        <blockquote>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna
            aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
          </p>
        </blockquote>
        <p class="mb0">&mdash; Ben Goodrich</p>
      </div>
    </div>

  </div>
</div>
</section>

<section class="probootstrap-section probootstrap-cta">
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2 text-center">
      <h2 class="probootstrap-heading">Join With Over 100K Members</h2>
      <p class="probootstrap-sub-heading">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
        incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi
        ut aliquip ex ea commodo consequat. </p>
      @guest
        <p><a href="{{ route('register') }}" class="btn btn-black">Get Started</a></p>
      @else
        <p><a href="{{ route('working_area') }}" class="btn btn-black">Get Started</a></p>
      @endguest
    </div>
  </div>
</div>
</section>
<section class="probootstrap-section probootstrap-bg-light" data-section="contact">
<div class="container">
  <div class="row">
    <div class="col-md-6 col-xs-12">
      <form action="" class="probootstrap-form">
        <h2 class="text-black mt0">Get In Touch</h2>
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Your Name">
        </div>
        <div class="form-group">
          <input type="email" class="form-control" placeholder="Your Email">
        </div>
        <div class="form-group">
          <input type="email" class="form-control" placeholder="Your Phone">
        </div>
        <div class="form-group">
          <textarea class="form-control" cols="30" rows="10" placeholder="Write a Message"></textarea>
        </div>
        <div class="form-group">
          <input type="submit" class="btn btn-primary" value="Send Message">
        </div>
      </form>
    </div>
    <div class="col-md-3 col-xs-12 col-md-push-1">
      <ul class="probootstrap-contact-details">
        <li>
          <span class="text-uppercase">Email</span>
          <a href="/cdn-cgi/l/email-protection" class="__cf_email__"
            data-cfemail="6d1d1f020f0202191e191f0c1d2d0a000c0401430e0200">info@admin.com</a>
        </li>
        <li>
          <span class="text-uppercase">Phone</span>
          +30 976 1382 9921
        </li>
        <li>
          <span class="text-uppercase">Fax</span>
          +30 976 1382 9922
        </li>
        <li>
          <span class="text-uppercase">Address</span>
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
<script src="{{ asset('assets/js/custom.js') }}"></script>
@endsection