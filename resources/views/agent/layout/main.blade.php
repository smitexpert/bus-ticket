
<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="keywords" content="admin,dashboard">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- The above 6 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        
        <!-- Title -->
        <title>Jatra Dashboard</title>

        <!-- Styles -->
        <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
        <link href="{{ asset("backend") }}/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="{{ asset("backend") }}/assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <link href="{{ asset("backend") }}/assets/plugins/icomoon/style.css" rel="stylesheet">
        <link href="{{ asset("backend") }}/assets/plugins/uniform/css/default.css" rel="stylesheet"/>
        <link href="{{ asset("backend") }}/assets/plugins/switchery/switchery.min.css" rel="stylesheet"/>
        <link href="{{ asset("backend") }}/assets/plugins/nvd3/nv.d3.min.css" rel="stylesheet">  
        @stack('styles')
        <!-- Theme Styles -->
        <link href="{{ asset("backend") }}/assets/css/space.min.css" rel="stylesheet">
        <link href="{{ asset("backend") }}/assets/css/custom.css" rel="stylesheet">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        
        <!-- Page Container -->
        <div class="page-container">
            @include('agent.partial.sidenav')
            
            <!-- Page Content -->
            <div class="page-content">
                <!-- Page Header -->
                <div class="page-header">
                    @include('agent.partial.topnav')
                </div><!-- /Page Header -->
                <!-- Page Inner -->
                <div class="page-inner">
                    <div id="main-wrapper">
                        @yield('content')
                    </div><!-- Main Wrapper -->
                    <div class="page-footer">
                        <p>Made with <i class="fa fa-heart"></i> by stacks</p>
                    </div>
            </div><!-- /Page Content -->
        </div><!-- /Page Container -->
        
        
        <!-- Javascripts -->
        <script src="{{ asset("backend") }}/assets/plugins/jquery/jquery-3.1.0.min.js"></script>
        <script src="{{ asset("backend") }}/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
        <script src="{{ asset("backend") }}/assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>
        <script src="{{ asset("backend") }}/assets/plugins/uniform/js/jquery.uniform.standalone.js"></script>
        <script src="{{ asset("backend") }}/assets/plugins/switchery/switchery.min.js"></script>
        <script src="{{ asset("backend") }}/assets/plugins/d3/d3.min.js"></script>
        <script src="{{ asset("backend") }}/assets/plugins/nvd3/nv.d3.min.js"></script>
        <script src="{{ asset("backend") }}/assets/plugins/flot/jquery.flot.min.js"></script>
        <script src="{{ asset("backend") }}/assets/plugins/flot/jquery.flot.time.min.js"></script>
        <script src="{{ asset("backend") }}/assets/plugins/flot/jquery.flot.symbol.min.js"></script>
        <script src="{{ asset("backend") }}/assets/plugins/flot/jquery.flot.resize.min.js"></script>
        <script src="{{ asset("backend") }}/assets/plugins/flot/jquery.flot.tooltip.min.js"></script>
        <script src="{{ asset("backend") }}/assets/plugins/flot/jquery.flot.pie.min.js"></script>
        <script src="{{ asset("backend") }}/assets/plugins/chartjs/chart.min.js"></script>
        <script src="{{ asset("backend") }}/assets/js/space.min.js"></script>
        {{-- <script src="{{ asset("backend") }}/assets/js/pages/dashboard.js"></script> --}}
        @stack('scripts')
        <script>
            $("ul.sub-menu li a.active").closest("ul").closest("li").addClass('active-page');
        </script>
    </body>
</html>