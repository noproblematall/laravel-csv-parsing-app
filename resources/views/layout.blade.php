<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>App title &mdash; Homepage</title>
  <meta name="description" content="web app to upload and parse any csv" />
  <meta name="keywords" content="upload csv,parse csv" />
  <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap-4.3.1-dist/css/bootstrap.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/vendor/fontawesome-free-5.7.2-web/css/all.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/css/styles-merged.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/css/style.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/fonts/icomoon/style.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />
  @yield('scripts')
  <!--[if lt IE 9]>
      <script src="js/vendor/html5shiv.min.js"></script>
      <script src="js/vendor/respond.min.js"></script>
    <![endif]-->
</head>

<body class="{{$index}}">

  <!-- Fixed navbar -->
  <nav class="navbar navbar-default probootstrap-navbar">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse"
          aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.html" title="Logo">Logo</a>
      </div>

      <div id="navbar-collapse" class="navbar-collapse collapse">
        <ul class="nav navbar-nav navbar-right">
          <li class="active"><a href="#" data-nav-section="home">Home</a></li>
          <li><a href="#" data-nav-section="pricing">Pricing</a></li>
          <li><a href="#" data-nav-section="reviews">Reviews</a></li>
          <li><a href="#" data-nav-section="contact">Contact</a></li>
          <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>
          <li><a href="#" id="signin">Sign in</a></li>
          <li><a href="#" id="signup">Sign up</a></li>
        </ul>
      </div>
    </div>
  </nav>

  @yield('content')

  <footer class="probootstrap-footer">
    <div class="container text-center">
      <div class="row">
        <div class="col-md-12">
          &copy; 2019 All Rights Reserved.
        </div>
      </div>
    </div>
  </footer>

  <a id="qodef-back-to-top" href="#" class="on">
      <span class="qodef-icon-stack">
        <i class="qodef-icon-font-awesome fa fa-chevron-up "></i>
      </span>
  </a>

  <div id="signup-modal" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h3 class="modal-title">Sign up</h3>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-sm-12">
              <form action="r" method="post" accept-charset="utf-8" class="myform form" role="form">
                <div class="row">
                  <div class="col-xs-6 col-md-6">
                    <input type="text" name="firstname" value="" class="form-control input-lg" placeholder="First Name" />
                  </div>
                  <div class="col-xs-6 col-md-6">
                    <input type="text" name="lastname" value="" class="form-control input-lg" placeholder="Last Name" />
                  </div>
                </div>
                <input type="text" name="email" value="" class="form-control input-lg" placeholder="Your Email" />
                <input type="password" name="password" value="" class="form-control input-lg" placeholder="Password" />
                <input type="password" name="confirm_password" value="" class="form-control input-lg" placeholder="Confirm Password" />
                <label>Birth Date</label>
                <div class="row">
                  <div class="col-xs-4 col-md-4">
                    <select name="month" class="form-control input-lg">
                      <option value="01">Jan</option>
                      <option value="02">Feb</option>
                      <option value="03">Mar</option>
                      <option value="04">Apr</option>
                      <option value="05">May</option>
                      <option value="06">Jun</option>
                      <option value="07">Jul</option>
                      <option value="08">Aug</option>
                      <option value="09">Sep</option>
                      <option value="10">Oct</option>
                      <option value="11">Nov</option>
                      <option value="12">Dec</option>
                    </select>
                  </div>
                  <div class="col-xs-4 col-md-4">
                    <select name="day" class="form-control input-lg">
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                      <option value="5">5</option>
                      <option value="6">6</option>
                      <option value="7">7</option>
                      <option value="8">8</option>
                      <option value="9">9</option>
                      <option value="10">10</option>
                      <option value="11">11</option>
                      <option value="12">12</option>
                      <option value="13">13</option>
                      <option value="14">14</option>
                      <option value="15">15</option>
                      <option value="16">16</option>
                      <option value="17">17</option>
                      <option value="18">18</option>
                      <option value="19">19</option>
                      <option value="21">21</option>
                      <option value="22">22</option>
                      <option value="23">23</option>
                      <option value="24">24</option>
                      <option value="25">25</option>
                      <option value="26">26</option>
                      <option value="27">27</option>
                      <option value="28">28</option>
                      <option value="29">29</option>
                      <option value="30">30</option>
                      <option value="31">31</option>
                    </select>
                  </div>
                  <div class="col-xs-4 col-md-4">
                    <select name="year" class="form-control input-lg">
                      <option value="2001">2001</option>
                      <option value="2002">2002</option>
                      <option value="2003">2003</option>
                      <option value="2004">2004</option>
                      <option value="2005">2005</option>
                      <option value="2006">2006</option>
                      <option value="2007">2007</option>
                      <option value="2008">2008</option>
                      <option value="2009">2009</option>
                      <option value="2010">2010</option>
                      <option value="2011">2011</option>
                      <option value="2012">2012</option>
                      <option value="2013">2013</option>
                    </select>
                  </div>
                </div>
                <label>Gender : </label>
                <label class="radio-inline">
                  <input type="radio" name="gender" value="M" id=male />Male
                </label>
                <label class="radio-inline">
                  <input type="radio" name="gender" value="F" id=female />Female
                </label>
                <br />
                <span class="help-block">By clicking Create my account, you agree to our Terms and that you have read our Data Use
                  Policy, including our Cookie Use.</span>
                <button class="btn btn-lg btn-primary btn-block signup-btn mb20" type="submit">Create my account</button>
                <p class="text-center mb10">Already have an account? <a href="#" id="to-signin">Sign in here</a>.</p>
              </form>
            </div>
          </div>
        </div>
      </div>
  
    </div>
  </div>

  <div id="signin-modal" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h3 class="modal-title">Sign in</h3>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-sm-12">
              <form action="r" method="post" accept-charset="utf-8" class="myform form" role="form">
                <input type="text" name="email" value="" class="form-control input-lg" placeholder="Your Email" />
                <input type="password" name="password" value="" class="form-control input-lg mb20" placeholder="Password" />
                <input type="checkbox" name="remember_me" id="remember_me" /> <label for="remember_me">Remember me</label>
                <br />
                <br />
                <button class="btn btn-lg btn-primary btn-block signup-btn mb20" type="submit">Sign in</button>
                <p class="text-center mb10">Don't have an account? <a href="#" id="to-signup">Sign up here</a>.</p>
              </form>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>

  <script src="{{ asset('assets/js/scripts.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/bootstrap-4.3.1-dist/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('assets/js/custom.js') }}"></script>
  <script src="{{ asset('assets/js/script.js') }}"></script>
  @yield('scripts')
</body>

</html>