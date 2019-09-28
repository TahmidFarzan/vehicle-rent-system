<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> @yield('title')</title>

    <!-- Styles -->

     <!-- Bootstrap css -->
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-theme.css') }}" rel="stylesheet">
    <!-- Template css -->
    <link href="{{ asset('css/sb-admin-2.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.css') }}" rel="stylesheet">
    <!-- my_vrs css -->
    <link href="{{ asset('css/my_vrs_admin.css') }}" rel="stylesheet">

</head>
<body>
    <div id="app">

        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#side-navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ route('admin.index') }}">Admin</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                
                @auth('admin')
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                       {{ Auth::user()->name }}<i class="fa fa-user fa-fw"></i><i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu doubleTapToGo">
                        <li><a href="{{ route('admin_setting.index') }}"><i class="glyphicon glyphicon-cog"></i> Admin Setting</a></li>
                        <li class="divider"></li>
                        <li>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="glyphicon glyphicon-circle-arrow-left"> Logout</a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                            </form>
                       </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
               @endauth
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse collapse" id="side-navbar">
                    <ul class="nav" id="side-menu">
                      <!--
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
                        </li>
                       -->
                        <li>
                            <a href="{{ route('admin.index') }}"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="{{ route('admin-service.index') }}"><i class="glyphicon glyphicon-certificate"></i> Service</a>
                        </li>
                        <li>
                            <a data-toggle="collapse" data-target="#Add_book_rent_info"><i class="fa fa-dashboard fa-fw"></i> Book rent<span class="fa arrow"></span></a>
                            <ul id="Add_book_rent_info" class="collapse nav nav-second-level">
                                <li><a href="{{ route('admin-vehicle_book_rent.index') }}" class="glyphicon glyphicon-bed"> Vehicle</a></li>
                                <li><a href="{{ route('admin-event_book_rent.index') }}"  class="glyphicon glyphicon-calendar"> Event</a></li>
                             </ul>
                        </li>
                        <li>
                            <a data-toggle="collapse" data-target="#Add_home_info"><i class="fa fa-edit fa-fw"></i>Home info<span class="fa arrow"></span></a>
                            <ul id="Add_home_info" class="collapse nav nav-second-level">
                                <li><a href="{{ route('admin-home_detail.index') }}" class="glyphicon glyphicon-home"> Home</a></li>
                                <li><a href="{{ route('admin-home_slider.index') }}"  class="glyphicon glyphicon-expand"> Slider</a></li>
                             </ul>
                        </li>
                         <li>
                            <a data-toggle="collapse" data-target="#Add_info"><i class="fa fa-edit fa-fw"></i> Event,Route & Vehicle info<span class="fa arrow"></span></a>
                            <ul id="Add_info" class="collapse nav nav-second-level">
                                <li><a href="{{ route('admin-event.index') }}"><i class="glyphicon glyphicon-calendar"></i> Event</a></li>
                                <li><a href="{{ route('admin-route.index') }}" class="glyphicon glyphicon-road"> Route</a></li>
                                <li><a href="{{ route('admin-vehicle.index') }}" class="glyphicon glyphicon-bed"> Vehicle</a></li>
                             </ul>
                        </li>
                         <li>
                            <a data-toggle="collapse" data-target="#Add_price_info"><i class="fa fa-edit fa-fw"></i>Price  info<span class="fa arrow"></span></a>
                            <ul id="Add_price_info" class="collapse nav nav-second-level">
                                <li><a href="{{ route('admin-event_price.index') }}" class="glyphicon glyphicon-usd"> Event Price</a></li>
                                <li><a href="{{ route('admin-vehicle_rent_price.index') }}"  class="glyphicon glyphicon-usd"> Vehicle Rent</a></li>
                             </ul>
                        </li>

                        <li>
                            <a href="{{ route('admin-contact.index') }}"><i class="glyphicon glyphicon-info-sign"></i> Contact Us</a>
                        </li>

                        <li>
                            <a href="{{ route('admin-about_us.index') }}"><i class="glyphicon glyphicon-info-sign"></i> About Us</a>
                        </li>

                        <li>
                            <a href="{{ route('admin-register_user_list.index') }}"><i class="glyphicon glyphicon-user"></i> Regester member list</a>
                        </li>
                        
                        <li>
                            <a href="{{ route('admin-rent_mail.index') }}"><i class="glyphicon glyphicon-envelope"></i> Rent mail</a>
                        </li>
                       
                       
                        
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
         
            @yield('content')
     
         @include('layouts.app_admin_footer')
    </div>

   <!-- Scripts -->
   <!-- <script src="{{ asset('js/app.js') }}"></script> (Old version so jquery validation not work)-->
     <script src="{{asset('js/jquery-3.3.1.js')}}"></script>
    <!-- Jquery Scripts -->
    <script src="{{ asset('js/bootstrap.js') }}"></script>
       
</body>
</html>
