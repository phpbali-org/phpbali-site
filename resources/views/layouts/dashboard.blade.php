<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="phpbali">
    <meta name="author" content="PHPBali">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app-dashboard.css') }}" />
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    @yield('additional-style')
    <style type="text/css">
        .sub-menu{
            display: none;
        }

        .sub-menu ul{
            padding-top: 14px;
        }

        .sub-menu li{
            padding-bottom: 14px;
        }

        label {
            font-weight: 600;
        }
    </style>
</head>

<body>
    <!-- Preloader -->
    <div class="preloader">
        <div class="cssload-speeding-wheel"></div>
    </div>
    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top m-b-0">
            <div class="navbar-header"> <a class="navbar-toggle hidden-sm hidden-md hidden-lg " href="javascript:void(0)" data-toggle="collapse" data-target=".navbar-collapse"><i class="fa fa-bars"></i></a>
                <div class="top-left-part" style="height: 60px">
                    <a class="logo" href="/" target="_blank">
                        <h2 style="text-align: center;color: #fff;">PHPBali</h2>
                    </a>
                </div>
                <ul class="nav navbar-top-links navbar-left m-l-20 hidden-xs">
                    <li>
                        <form role="search" class="app-search hidden-xs">
                            <input type="text" placeholder="Search..." class="form-control"> <a href=""><i class="fa fa-search"></i></a>
                        </form>
                    </li>
                </ul>
                <ul class="nav navbar-top-links navbar-right pull-right">
                    <li class="dropdown">
                        <a class="profile-pic" class="dropdown-toggle" data-toggle="dropdown" href="#"> <img src="{{ asset('img/user.png') }}" alt="user-img" width="36" class="img-circle">
                            <b class="hidden-xs">{{ Auth::user()->name }}</b> 
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();" class="btn btn-link">
                                    Sign Out
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-header -->
            <!-- /.navbar-top-links -->
            <!-- /.navbar-static-side -->
        </nav>
        <!-- Left navbar-header -->
        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse slimscrollsidebar">
                <ul class="nav" id="side-menu">
                    <li style="padding: 10px 0 0;">
                        <a href="#" class="waves-effect" id="toggle-sub-menu-manage">
                            <i class="fa fa-calendar fa-fw" aria-hidden="true"></i>
                            <span class="hide-menu">Events</span>
                        </a>
                        <span class="sub-menu" id="sub-menu-manage">
                            <ul>
                                <li>
                                    <a href="{{ route('admin.event') }}" class="waves-effect">
                                        <i class="fa fa-calendar-plus-o fa-fw"></i>
                                        <span class="hide-menu">Events</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.topic') }}" class="waves-effect">
                                        <i class="fa fa-comments-o fa-fw"></i>
                                        <span class="hide-menu">Topics</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="waves-effect">
                                        <i class="fa fa-pencil-square-o fa-fw"></i>
                                        <span class="hide-menu">RSVPs</span>
                                    </a>
                                </li>
                            </ul>
                        </span>
                    </li>
                    <li style="padding: 10px 0 0;">
                        <a href="{{ route('admin.members') }}" class="waves-effect">
                            <i class="fa fa-users fa-fw" aria-hidden="true"></i>
                            <span class="hide-menu">Members</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- Left navbar-header end -->
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                @yield('content')
            </div>
            <!-- /.container-fluid -->
            <footer class="footer text-center"> 2018 &copy; PHPBali </footer>
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
    <!-- jQuery -->
    <script src="{{ asset('js/app-dashboard.js') }}"></script>
    @yield('additional-scripts')
</body>
</html>