
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    {{-- <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico"> --}}

    <title>Jatra : Counter Dashboard</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('website/assets/css') }}/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset("backend") }}/assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    @stack('styles')
    <!-- Custom styles for this template -->
  </head>

  <body>

    <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('/') }}">
                Jatra
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a href="{{ route('counter.sell.ticket') }}" class="nav-link">Sell Ticket</a>
                    </li>
                    {{-- <li class="nav-item">
                        <a href="{{ route('agent.manifest.counter') }}" class="nav-link">Print Manifest</a>
                    </li> --}}
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::guard('agent')->user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('agent.logout') }}"
                                onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('agent.logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')
    
    <div class="container">
      <footer class="pt-4 my-md-5 pt-md-5 border-top">
        <div class="row">
          <div class="col-md-4 col-md">
            <img class="mb-2" src="{{ asset('logo') }}/jatra_logo.svg" alt="">
            <small class="d-block mb-3 text-muted">&copy;{{ date('Y') }}</small>
          </div>
          
        </div>
      </footer>
    </div>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="{{ asset('website/assets') }}/js/jquery-3.4.1.min.js"></script>
    
    <script src="{{ asset('website/assets') }}/js/popper.min.js"></script>
    <script src="{{ asset('website/assets') }}/js/bootstrap.min.js"></script>
    @stack('scripts')
  </body>
</html>
