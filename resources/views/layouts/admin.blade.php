<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 2 | Dashboard</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="{{ asset('admin_assets/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin_assets/bower_components/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin_assets/bower_components/Ionicons/css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin_assets/bower_components/jvectormap/jquery-jvectormap.css') }}">
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
        <a href="{{route('home')}}" class="logo">
            <span class="logo-mini"><b>LG</b></span>
            <span class="logo-lg"><b>LOGO</b></span>
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
                <li class="{{ $index==='dataset' ? 'active' : null }}">
                    <a href="#">
                        <i class="fa fa-database"></i> <span>Dataset management</span>
                    </a>
                </li>
                <li class="{{ $index==='user' ? 'active' : null }}">
                    <a href="{{ route('admin.user') }}">
                        <i class="fa fa-users"></i> <span>User management</span>
                    </a>
                </li>
                <li class="{{ $index==='package' ? 'active' : null }}">
                    <a href="#">
                        <i class="fa fa-user-md"></i> <span>Package management</span>
                    </a>
                </li>
                <li class="{{ $index==='payment' ? 'active' : null }}">
                    <a href="#">
                        <i class="fa fa-credit-card"></i> <span>Payment history</span>
                    </a>
                </li>
                <li class="{{ $index==='contact' ? 'active' : null }}">
                    <a href="#">
                        <i class="fa fa-whatsapp"></i> <span>Contact management</span>
                    </a>
                </li>
                <li class="{{ $index==='setting' ? 'active' : null }}">
                    <a href="#">
                        <i class="fa fa-gears"></i> <span>Settings</span>
                    </a>
                </li>
            </ul>
        </section>
    </aside>
    
        @yield('content')
        <!-- /.content-wrapper -->
    
        <footer class="main-footer">
            <strong>Copyright &copy; 2019 </strong> All rights reserved.
        </footer>
    
        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Create the tabs -->
            <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
            <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
            <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
            <!-- Home tab content -->
            <div class="tab-pane" id="control-sidebar-home-tab">
                <h3 class="control-sidebar-heading">Recent Activity</h3>
                <ul class="control-sidebar-menu">
                <li>
                    <a href="javascript:void(0)">
                    <i class="menu-icon fa fa-birthday-cake bg-red"></i>
    
                    <div class="menu-info">
                        <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>
    
                        <p>Will be 23 on April 24th</p>
                    </div>
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0)">
                    <i class="menu-icon fa fa-user bg-yellow"></i>
    
                    <div class="menu-info">
                        <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>
    
                        <p>New phone +1(800)555-1234</p>
                    </div>
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0)">
                    <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>
    
                    <div class="menu-info">
                        <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>
    
                        <p>nora@example.com</p>
                    </div>
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0)">
                    <i class="menu-icon fa fa-file-code-o bg-green"></i>
    
                    <div class="menu-info">
                        <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>
    
                        <p>Execution time 5 seconds</p>
                    </div>
                    </a>
                </li>
                </ul>
                <!-- /.control-sidebar-menu -->
    
                <h3 class="control-sidebar-heading">Tasks Progress</h3>
                <ul class="control-sidebar-menu">
                <li>
                    <a href="javascript:void(0)">
                    <h4 class="control-sidebar-subheading">
                        Custom Template Design
                        <span class="label label-danger pull-right">70%</span>
                    </h4>
    
                    <div class="progress progress-xxs">
                        <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                    </div>
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0)">
                    <h4 class="control-sidebar-subheading">
                        Update Resume
                        <span class="label label-success pull-right">95%</span>
                    </h4>
    
                    <div class="progress progress-xxs">
                        <div class="progress-bar progress-bar-success" style="width: 95%"></div>
                    </div>
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0)">
                    <h4 class="control-sidebar-subheading">
                        Laravel Integration
                        <span class="label label-warning pull-right">50%</span>
                    </h4>
    
                    <div class="progress progress-xxs">
                        <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
                    </div>
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0)">
                    <h4 class="control-sidebar-subheading">
                        Back End Framework
                        <span class="label label-primary pull-right">68%</span>
                    </h4>
    
                    <div class="progress progress-xxs">
                        <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
                    </div>
                    </a>
                </li>
                </ul>
                <!-- /.control-sidebar-menu -->
    
            </div>
            <!-- /.tab-pane -->
    
            <!-- Settings tab content -->
            <div class="tab-pane" id="control-sidebar-settings-tab">
                <form method="post">
                <h3 class="control-sidebar-heading">General Settings</h3>
    
                <div class="form-group">
                    <label class="control-sidebar-subheading">
                    Report panel usage
                    <input type="checkbox" class="pull-right" checked>
                    </label>
    
                    <p>
                    Some information about this general settings option
                    </p>
                </div>
                <!-- /.form-group -->
    
                <div class="form-group">
                    <label class="control-sidebar-subheading">
                    Allow mail redirect
                    <input type="checkbox" class="pull-right" checked>
                    </label>
    
                    <p>
                    Other sets of options are available
                    </p>
                </div>
                <!-- /.form-group -->
    
                <div class="form-group">
                    <label class="control-sidebar-subheading">
                    Expose author name in posts
                    <input type="checkbox" class="pull-right" checked>
                    </label>
    
                    <p>
                    Allow the user to show his name in blog posts
                    </p>
                </div>
                <!-- /.form-group -->
    
                <h3 class="control-sidebar-heading">Chat Settings</h3>
    
                <div class="form-group">
                    <label class="control-sidebar-subheading">
                    Show me as online
                    <input type="checkbox" class="pull-right" checked>
                    </label>
                </div>
                <!-- /.form-group -->
    
                <div class="form-group">
                    <label class="control-sidebar-subheading">
                    Turn off notifications
                    <input type="checkbox" class="pull-right">
                    </label>
                </div>
                <!-- /.form-group -->
    
                <div class="form-group">
                    <label class="control-sidebar-subheading">
                    Delete chat history
                    <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
                    </label>
                </div>
                <!-- /.form-group -->
                </form>
            </div>
            <!-- /.tab-pane -->
            </div>
        </aside>
        <!-- /.control-sidebar -->
        <!-- Add the sidebar's background. This div must be placed
            immediately after the control sidebar -->
        <div class="control-sidebar-bg"></div>
    
        </div>

  <script src="{{ asset('admin_assets/bower_components/jquery/dist/jquery.min.js')}}"></script>
  <script src="{{ asset('admin_assets/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
  <script src="{{ asset('admin_assets/bower_components/fastclick/lib/fastclick.js')}}"></script>
  <script src="{{ asset('admin_assets/js/adminlte.min.js')}}"></script>
  <script src="{{ asset('admin_assets/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js')}}"></script>
  <script src="{{ asset('admin_assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
  <script src="{{ asset('admin_assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
  <script src="{{ asset('admin_assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
  <script src="{{ asset('admin_assets/bower_components/chart.js/Chart.js')}}"></script>
  <script src="{{ asset('admin_assets/js/pages/dashboard2.js')}}"></script>
  <script src="{{ asset('admin_assets/js/demo.js')}}"></script>
  @yield('scripts')
</body>

</html>