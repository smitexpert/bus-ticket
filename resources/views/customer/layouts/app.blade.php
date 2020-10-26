
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    {{-- <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico"> --}}

    <title>Jatra : Cutomer Dashboard</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('website/assets/css') }}/bootstrap.min.css" rel="stylesheet">

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

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a href="{{ route('customer.purchase.index') }}" class="nav-link">Purchase</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::guard('customer')->user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('customer.logout') }}"
                                onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('customer.logout') }}" method="POST" style="display: none;">
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
          <div class="col-12 col-md">
            <img class="mb-2" src="{{ asset('logo') }}/jatra_logo.svg" alt="">
            <small class="d-block mb-3 text-muted">&copy;{{ date('Y') }}</small>
          </div>
          <div class="col-6 col-md">
            <h5>Navigation</h5>
            <ul class="list-unstyled text-small">
              <li><a class="text-muted" href="#">Offers</a></li>
              <li><a class="text-muted" href="#">Travel Blogs</a></li>
              <li><a class="text-muted" href="#">About Us</a></li>
              <li><a class="text-muted" href="#">Contact Us</a></li>
              <li><a class="text-muted" href="#">Privacy Policy</a></li>
            </ul>
          </div>
          <div class="col-6 col-md">
            <h5>Services</h5>
            <ul class="list-unstyled text-small">
              <li><a class="text-muted" href="#">Bus</a></li>
              <li><a class="text-muted" href="#">Train</a></li>
              <li><a class="text-muted" href="#">Flight</a></li>
              <li><a class="text-muted" href="#">Cabs</a></li>
            </ul>
          </div>
          <div class="col-6 col-md">
            <h5>Action</h5>
            <ul class="list-unstyled text-small">
              <li><a class="text-muted" href="#">Login</a></li>
              <li><a class="text-muted" href="#">Registration</a></li>
              <li><a class="text-muted" href="#">Cancel Ticket</a></li>
              <li><a class="text-muted" href="#">Supports</a></li>
            </ul>
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
  </body>
</html>
