<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin | {{$title}}</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="{{ asset('admin_assets/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin_assets/bower_components/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin_assets/bower_components/Ionicons/css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin_assets/css/AdminLTE.min.css')}}">
    <link rel="stylesheet" href="{{ asset('admin_assets/css/skins/_all-skins.min.css')}}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link rel="stylesheet" href="{{ asset('admin_assets/css/style.css')}}">
    @yield('styles')
</head>

<body class="hold-transition skin-blue sidebar-mini">
<input type="hidden" name="_base_url" value="{{asset('/')}}" />
<div class="wrapper">
    <header class="main-header">
        <a href="{{route('home')}}" class="logo" target="_blank">
            <span class="logo-mini"><b>AP</b></span>
            <span class="logo-lg"><b>Admin Panel</b></span>
        </a>

        <nav class="navbar navbar-static-top">

            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="{{asset('admin_assets/img/default.png')}}" class="user-image" alt="User Image">
                        <span class="hidden-xs">{{Auth::user()->f_name}} {{Auth::user()->l_name}}</span>
                        </a>
                        <ul class="dropdown-menu">
                        <li class="user-header">
                            <img src="{{asset('admin_assets/img/default.png')}}" class="img-circle" alt="User Image">
        
                            <p>
                            {{Auth::user()->f_name}} {{Auth::user()->l_name}} - Administrator
                            </p>
                        </li>
                        <li class="user-footer">
                            <div class="pull-left">
                            <a href="#" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                            <a href="#" class="btn btn-default btn-flat" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">Sign out</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            </div>
                        </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <aside class="main-sidebar">
        <section class="sidebar">
            <div class="user-panel">
                <div class="pull-left image">
                <img src="{{asset('admin_assets/img/default.png')}}" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                <p>{{Auth::user()->f_name}} {{Auth::user()->l_name}}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>
            <form action="#" method="get" class="sidebar-form">
                <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat">
                    <i class="fa fa-search"></i>
                    </button>
                </span>
                </div>
            </form>
            <ul class="sidebar-menu" data-widget="tree">
                <li class="header">MAIN NAVIGATION</li>
                <li class="{{ $index==='home' ? 'active' : null }}">
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                    </a>
                </li>
                {{-- <li class="{{ $index==='dataset' ? 'active' : null }}">
                    <a href="{{ route('admin.dataset') }}">
                        <i class="fa fa-database"></i> <span>Dataset management</span>
                    </a>
                </li> --}}
                <li class="{{ $index==='user' ? 'active' : null }}">
                    <a href="{{ route('admin.user') }}">
                        <i class="fa fa-users"></i> <span>User management</span>
                    </a>
                </li>
                <li class="{{ $index==='package' ? 'active' : null }}">
                    <a href="{{ route('admin.package') }}">
                        <i class="fa fa-user-md"></i> <span>Package management</span>
                    </a>
                </li>
                <li class="{{ $index==='process' ? 'active' : null }}">
                    <a href="{{ route('admin.process') }}">
                        <i class="fa fa-th-list"></i> <span>Process management</span>
                    </a>
                </li>
                <li class="{{ $index==='payment' ? 'active' : null }}">
                    <a href="{{ route('admin.payment') }}">
                        <i class="fa fa-credit-card"></i> <span>Payment history</span>
                    </a>
                </li>
                <li class="{{ $index==='setting' ? 'active' : null }}">
                    <a href="{{ route('admin.setting') }}">
                        <i class="fa fa-gears"></i> <span>Settings</span>
                    </a>
                </li>
            </ul>
        </section>
    </aside>
    
    @yield('content')

    <footer class="main-footer">
        <strong>Copyright &copy; 2019 </strong> All rights reserved.
    </footer>

  <script src="{{ asset('admin_assets/bower_components/jquery/dist/jquery.min.js')}}"></script>
  <script src="{{ asset('admin_assets/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
  <script src="{{ asset('admin_assets/js/adminlte.min.js')}}"></script>
  
  @yield('scripts')
</body>

</html>