<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" style=" height: 100%;">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('','TStore') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
    html {
      height: 100%;
    }
    body {
      display: flex;
      flex-direction: column;
      height: 100vh; /* Avoid the IE 10-11 `min-height` bug. */
    }
    .contentMain {
      flex: 1 0 auto; /* Prevent Chrome, Opera, and Safari from letting these items shrink to smaller than their content's default minimum size. */
    }
    .footerMain {
      flex-shrink: 0; /* Prevent Chrome, Opera, and Safari from letting these items shrink to smaller than their content's default minimum size. */
      padding: 20px;
    }
    </style>

</head>


<body>
    <div id="app" class="contentMain"><!-- app -->
        <nav class="navbar navbar-expand-sm bg-dark navbar-dark" style="color:white">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/home') }}">
                    {{ config('','TStore') }}
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
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif

                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre style="color:white">Menu</a>
                                <div><span class="caret"></span></div>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    @if(auth()->user()->role == 'admin')
                                    <a class="dropdown-item" href="{{route('viewTransaction')}}">Transaction</a>
                                    <a class="dropdown-item" href="{{route('viewCategory')}}">Category</a>
                                    @endif
                                    <a class="dropdown-item" href="{{route('viewStore')}}">Store</a>
                                    <a class="dropdown-item" href="{{route('viewCart')}}">Cart</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre style="color:white">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{route('profileUser')}}">Profile</a>
                                    <a class="dropdown-item" href="{{route('logout')}}"
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
                        <li><span class="navbar-text mb-0" style="color:white"> &nbsp;{{ date('M d, Y') }}</span></li>
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <div >
                @yield('content')
            </div> 
        </main>
        
    </div>
    <div class="footerMain bg-dark" style="color:white">
          <div class="text-center text-md-left">
            <div class="row">
              <div class="col-md-6 mt-md-0 mt-3">
                <p>Copyright &copy; TStore <br>All Right Reserved</p>
              </div>
            </div>
          </div>
        </div>
</body>
</html>
