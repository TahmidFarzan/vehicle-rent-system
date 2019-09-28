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
    <link href="{{ asset('css/bootstrap-grid.css') }}" rel="stylesheet">
    <!-- my_vrs css -->
    <link href="{{ asset('css/my_vrs.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-fixed-top navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        VRS
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        <li class="active">
                            <a href="{{ url('/') }}"> Home</a>
                        </li>
                         <li>
                            <a href="{{ route('service.index') }}"> Service</a>
                        </li>
                        <li>
                            <a href="{{ route('event.index') }}" > Event</a>
                        </li>
                         <li>
                            <a href="{{ route('vehicle-list.index') }}" > Vehicle list</a>
                        </li>
                          <li>
                            <a href="{{ route('route-list.index') }}" > Route list</a>
                        </li>
                        
                        <li class="dropdown">
                           <a class="dropdown-toggle" data-toggle="dropdown"> Book rent <span class="glyphicon glyphicon-triangle-bottom"></span></a>
                            <ul id="book_rent" class="dropdown-menu my-navbar-dropdown-menu">
                                <li><a href="{{ route('vehicle-rent.index') }}"> Vehicle rent</a></li>
                                <li><a href="{{ route('event-rent.index') }}" > Event book</a></li>
                             </ul>
                        </li>
                         <li>
                           <a href="{{ route('contact-us.index') }}"> Contact us</a>
                         </li>
                         <li>
                           <a href="{{ route('about_us.index') }}"> About us</a>
                         </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                         <li class="dropdown">
                           <a class="dropdown-toggle" href="#" data-toggle="dropdown">Login panal <span class="glyphicon glyphicon-triangle-bottom"></span></a>
                            <ul class="dropdown-menu my-navbar-dropdown-menu">
                                <li><a href="{{ route('login') }}" class="glyphicon glyphicon-circle-arrow-right"> Member</a></li>
                                <li><a href="{{ route('admin.login') }}" class="glyphicon glyphicon-user"> Admin</a></li>
                            </ul>
                         </li>
                         
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle glyphicon glyphicon-user" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu my-navbar-dropdown-menu" role="menu">
                                    @auth('web')
                                      <li>
                                         <a href="{{ route('user_setting.index') }}"><i class="glyphicon glyphicon-cog"></i> User setting</a>
                                      </li>
                                    @endauth
                                     <li class="divider"></li>
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" class="glyphicon glyphicon-circle-arrow-left">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
         <div class="container my-container">
            @yield('content')
        </div>
        <div class="container my-footer-container">
           @if (Auth::guest())
            @include('layouts.app_footer')
           @endif
           @auth('web')
             @include('layouts.app_member_footer')
           @endauth
        </div>
    </div>

    <!-- Scripts -->
   <!-- <script src="{{ asset('js/app.js') }}"></script> (Old version so jquery validation not work)-->
     <script src="{{asset('js/jquery-3.3.1.js')}}"></script>
    <!-- Jquery Scripts -->
    <script src="{{ asset('js/bootstrap.js') }}"></script>
</body>
</html>
