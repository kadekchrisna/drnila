<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/js/sb-admin.min.js') }}"></script>



    <!-- Bootstrap core CSS-->
    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="{{ asset('fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="{{ asset('datatables/dataTables.bootstrap4.css') }}" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin.css') }}" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body style="font-family: Font Awesome 5 Free;">
    <div id="app">
        <nav class="navbar navbar-expand-md  navbar-dark bg-dark navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/homeadmindronila') }}">
                    Admin {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    Welcome, {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
    <div id="wrapper">

      <!-- Sidebar -->
      <ul class="sidebar navbar-nav">
        <li class="nav-item {{ Request::is('/') ? 'active ml-3' : '' }}">
          <a class="nav-link " href="{{ url('/') }}">
            <i class="fas fa-fw fa-user-alt"></i>
            <span class="">Home</span>
          </a>
        </li>
        <li class="nav-item {{ Request::is('homeadmindronila') ? 'active ml-3' : '' }}">
          <a class="nav-link " href="{{ url('homeadmindronila') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span class="">Dashboard</span>
          </a>
        </li>
        <li class="nav-item {{ Request::is('adminproduct') ? 'active ml-3' : '' }}">
          <a class="nav-link " href="{{ url('adminproduct') }}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Product</span></a>
        </li>
        <li class="nav-item {{ Request::is('adminpost') ? 'active ml-3 ' : '' }}">
          <a class="nav-link " href="{{ url('adminpost') }}">
            <i class="fas fa-fw fa-table"></i>
            <span class="">Posts</span></a>
        </li>

        
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-folder"></i>
            <span>Pages</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <h6 class="dropdown-header">Login Screens:</h6>
            <a class="dropdown-item" href="#">Login</a>
            <a class="dropdown-item" href="#">Register</a>
            <a class="dropdown-item" href="#">Forgot Password</a>
            <div class="dropdown-divider"></div>
            <h6 class="dropdown-header">Other Pages:</h6>
            <a class="dropdown-item" href="#">404 Page</a>
            <a class="dropdown-item active" href="blank.html">Blank Page</a>
          </div>
        </li>
      </ul>

      <div id="content-wrapper">

        <div class="container-fluid">
        @guest
          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="/homeadmindronila">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Welcome Guest</li>
            
          </ol>
          @else
          
          @include('inc.message')

          @endguest

          <!-- Page Content -->
          
            <main class="py-4">
                @yield('content')
            </main>

        </div>

    </div>

    <script src="{{ asset('/vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace( 'article-ckeditor' );
    </script>

</body>
</html>
