<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('website') }}/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('website') }}/assets/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="{{ asset('website') }}/assets/font/flaticon.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('website') }}/assets/css/flatpickr.min.css">
    <link rel="stylesheet" href="{{ asset('website') }}/assets/css/tiny-slider.css">
    <link rel="stylesheet" href="{{ asset('website') }}/assets/css/jquery-ui.css">
    <link rel="stylesheet" href="{{ asset('website') }}/style.css?{{ time() }}">
    <title>JATRA</title>
</head>
<body>
    @yield('content')
    <script src="{{ asset("website") }}/assets/js/jquery-3.4.1.min.js"></script>
    <script src="{{ asset("website") }}/assets/js/jquery-ui.js"></script>
    <script src="{{ asset("website") }}/assets/js/popper.min.js"></script>
    <script src="{{ asset("website") }}/assets/js/bootstrap.min.js"></script>
    <script src="{{ asset("website") }}/assets/js/bootstrap-select.min.js"></script>
    <script src="{{ asset("website") }}/assets/js/flatpickr.js"></script>
    <script src="{{ asset("website") }}/assets/js/tiny-slider.js"></script>
    <script src="{{ asset("website") }}/assets/js/main.js"></script>
    @stack('scripts')
</body>
</html>