@extends('website.layouts.main')
@section('content')
    
<div class="loading">
    <img src="{{ asset('/') }}/loading.gif" alt="">
</div>
<section class="top-section">
    <div class="container-fluid">
        <div class="top-nav">
            <div class="row">
                <div class="col-sm-4 col">
                    <div class="float-left">
                        <a href="{{ url('/') }}">
                            <img class="top-bar-logo" src="{{ asset('logo') }}/jatra_logo.svg" alt="">
                        </a>
                        {{-- <h1 class="top-bar-title"><a href="#">JATRA</a></h1> --}}
                    </div>
                </div>
                <div class="col-sm-8  col">
                    <div class="float-right">
                        <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#TicketCancelModel" id="show_cancel_area"><span class="fa fa-ticket"></span> Cancel Ticket</button>
                        {{-- <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#loginModal">Login</button>
                        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#signUpModal">Sign Up</button> --}}
                        <a href="{{ route('customer.login') }}" class="btn btn-sm btn-success">Login</a>
                        <a href="{{ route('customer.register') }}" class="btn btn-sm btn-primary">Sign Up</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="http://particleslider.com/js/particleslider/current/particleslider.js"></script>
    <div class="anime_logo" id="particle-slider">
        <div class="slides">
            <div class="slide" data-src="data:image/png;base64,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">
              </div>
            </div>
              <canvas class="draw"></canvas>
              
    </div>
    <div class="search-area">
        <div class="service-area">
            <div class="container-half">
                <div class="service-list">
                    <ul id="service_nav">
                        <li>
                            <a href="#" class="active" id="bus">
                                <span class="fa fa-bus"></span>
                                <span>BUS</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" id="train">
                                <span class="fa fa-train"></span>
                                <span>TRAIN</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" id="flight">
                                <span class="fa fa-plane"></span>
                                <span>FLIGHT</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" id="cabs">
                                <span class="fa fa-car"></span>
                                <span>CABS</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="select-area">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                        <br>
                        <br>
                        <div class="option option_show" id="option_bus">
                            <form action="#" id="bus_search_form">
                            {{-- <form action="{{ route("search.bus.get") }}" method="POST">
                                @csrf --}}
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="search-form">
                                            <label for="bus_form">From</label>
                                            <input type="text" id="bus_form" name="bus_form" placeholder="From City" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="search-form">
                                            <label for="bus_to">To</label>
                                            <input type="text" id="bus_to" name="bus_to" placeholder="To City" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="search-form">
                                            <label for="date">Travel Date</label>
                                            <input type="date" name="date" id="date" placeholder="Select Date" data-input>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="search_btn">
                                    <button id="bus" class="btn_search">SEARCH</button>
                                </div>
                            </form>
                        </div>
                        <div class="option" id="option_train">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="train_from">
                                            <p class="title">FROM</p>
                                            <h1 class="name">Dhaka</h1>
                                        </label>
                                        <div class="icon-input train_from">
                                            <span class="fa fa-search"></span><input type="text" id="train_from" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="train_to">
                                            <p class="title">TO</p>
                                            <h1 class="name">Dhaka</h1>
                                        </label>
                                        <div class="icon-input train_to">
                                            <span class="fa fa-search"></span><input type="text" id="train_to" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="train_date">
                                            <p class="title">Travel Date</p>
                                            <h1 class="name">Select Date</h1>
                                        </label>
                                        <div class="icon-input train_date">
                                            <input type="text" name="date" id="train_date" class="form-control">
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="train_class">
                                            <p class="title">Class</p>
                                            <h1 class="name">Select Date</h1>
                                        </label>
                                        <div class="icon-input train_class">
                                            <select name="train_class" id="train_class" class="form-control">
                                                <option value="Super">Super</option>
                                                <option value="Classic">Classic</option>
                                            </select>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="search_btn">
                                <button class="btn_search">SEARCH</button>
                            </div>
                        </div>
                        <div class="option" id="option_flight">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="flight_from">
                                            <p class="title">FROM</p>
                                            <h1 class="name">Dhaka</h1>
                                        </label>
                                        <div class="icon-input flight_from">
                                            <span class="fa fa-search"></span><input type="text" id="flight_from" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="flight_to">
                                            <p class="title">TO</p>
                                            <h1 class="name">Dhaka</h1>
                                        </label>
                                        <div class="icon-input flight_to">
                                            <span class="fa fa-search"></span><input type="text" id="flight_to" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="flight_date">
                                            <p class="title">Travel Date</p>
                                            <h1 class="name">Select Date</h1>
                                        </label>
                                        <div class="icon-input flight_date">
                                            <input type="text" name="flight_date" id="flight_date" class="form-control">
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="flight_return_date">
                                            <p class="title">Return Date (Optional)</p>
                                            <h1 class="name">Select Date</h1>
                                        </label>
                                        <div class="icon-input flight_return_date">
                                            <input type="text" name="flight_return_date" id="flight_return_date" class="form-control">
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="flight_class">
                                            <p class="title">Travellers & Class</p>
                                            <h1 class="name">Select</h1>
                                        </label>
                                        <div class="icon-input flight_class">
                                            <div class="class-pop">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="adult">Adult (12y+)</label>
                                                                    <select name="adult" id="adult" class="form-control">
                                                                        <option value="1">1</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="adult">CHILDREN (2y-12y)</label>
                                                                    <select name="adult" id="adult" class="form-control">
                                                                        <option value="1">1</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="adult">INFANTS (below 2y)</label>
                                                                    <select name="adult" id="adult" class="form-control">
                                                                        <option value="1">1</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="flight_class_option">Travel Class</label>
                                                                    <select name="flight_class_option" id="flight_class_option" class="form-control">
                                                                        <option value="Class All">Class All</option>
                                                                        <option value="Class One">Class One</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="float-right">
                                                                    <button id="class_apply" class="btn btn-sm btn-success">Apply</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="search_btn">
                                <button class="btn_search">SEARCH</button>
                            </div>
                        </div>
                        <div class="option" id="option_cabs">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="cabs_from">
                                            <p class="title">FROM</p>
                                            <h1 class="name">Dhaka</h1>
                                        </label>
                                        <div class="icon-input cabs_from">
                                            <span class="fa fa-search"></span><input type="text" id="cabs_from" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="cabs_to">
                                            <p class="title">TO</p>
                                            <h1 class="name">Dhaka</h1>
                                        </label>
                                        <div class="icon-input cabs_to">
                                            <span class="fa fa-search"></span><input type="text" id="cabs_to" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="cabs_date">
                                            <p class="title">Travel Date</p>
                                            <h1 class="name">Select Date</h1>
                                        </label>
                                        <div class="icon-input cabs_date">
                                            <input type="text" name="cabs_date" id="cabs_date" class="form-control">
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="cabs_return_date">
                                            <p class="title">Return Date (Optional)</p>
                                            <h1 class="name">Select Date</h1>
                                        </label>
                                        <div class="icon-input cabs_return_date">
                                            <input type="text" name="cabs_return_date" id="cabs_return_date" class="form-control">
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="cabs_pick_time">
                                            <p class="title">Pickup Time</p>
                                            <h1 class="name">Select</h1>
                                        </label>
                                        <div class="icon-input cabs_pick_time">
                                            <input type="text" name="cabs_pick_time" id="cabs_pick_time" class="form-control">
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="search_btn">
                                <button class="btn_search">SEARCH</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
</section>
<br>
<section class="result_section" id="result_section">
    <div class="container-fluid">
        <div class="result_area" id="result_bus">
            <div class="card">
                <div class="card-body">
                    <div class="btn-group">
                        <button data-filter="0" class="btn btn-sm btn-success bus_filter">All</button>
                        <button data-filter="1" class="btn btn-sm btn-info bus_filter">Non AC</button>
                        <button data-filter="2" class="btn btn-sm btn-info bus_filter">AC</button>
                    </div>
                    <br>
                    <br>
                    <table class="table table-stripped search_result_table" id="bus_search_tbl">
                        <thead>
                            <tr>
                                <th>Operator</th>
                                <th>Dep. Time</th>
                                <th>Arr. Time</th>
                                <th>Seats Available</th>
                                <th>Fare Charge</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<br>
<section class="banner_ads">
    <div class="container-fluid">
        <div class="ads_place">
            <h1>Ads Here</h1>
        </div>
    </div>
</section>
<br>

<!-- Offer section start -->
<section class="super_offer">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h2 class="offer_title">Super Offer</h2>
                    </div>
                    <div class="col-md-6">
                        <ul id="custom_control">
                            <li class="prev" data-controls="prev" aria-controls="customize" tabindex="-1">
                                <i class="fa fa-angle-left"></i>
                            </li>
                            <li class="next" data-controls="next" aria-controls="customize" tabindex="-1">
                                <i class="fa fa-angle-right"></i>          
                            </li>
                        </ul>
                    </div>
                </div>
                <br>
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <div id="slider">

                            <div class="slider-item">
                                <div class="card">
                                    <div class="card-body">
                                        <a href="#">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="slider-img">
                                                        <img class="img-fluid" src="http://via.placeholder.com/150x150" alt="">
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <h3 class="bold-title">
                                                        Lorem ipsum dolor sit amet.
                                                    </h3>
                                                    <p class="shadow-text">
                                                        Lorem ipsum dolor sit amet consectetur.
                                                    </p>
                                                </div>
                                                <div class="col-md-12">
                                                    <p class="book-now">
                                                        Book Now
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div> 
                            <!-- slider item end -->
                            <div class="slider-item">
                                <div class="card">
                                    <div class="card-body">
                                        <a href="#">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="slider-img">
                                                        <img class="img-fluid" src="http://via.placeholder.com/150x150" alt="">
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <h3 class="bold-title">
                                                        Lorem ipsum dolor sit amet.
                                                    </h3>
                                                    <p class="shadow-text">
                                                        Lorem ipsum dolor sit amet consectetur.
                                                    </p>
                                                </div>
                                                <div class="col-md-12">
                                                    <p class="book-now">
                                                        Book Now
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div> 
                            <!-- slider item end -->
                            <div class="slider-item">
                                <div class="card">
                                    <div class="card-body">
                                        <a href="#">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="slider-img">
                                                        <img class="img-fluid" src="http://via.placeholder.com/150x150" alt="">
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <h3 class="bold-title">
                                                        Lorem ipsum dolor sit amet.
                                                    </h3>
                                                    <p class="shadow-text">
                                                        Lorem ipsum dolor sit amet consectetur.
                                                    </p>
                                                </div>
                                                <div class="col-md-12">
                                                    <p class="book-now">
                                                        Book Now
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div> 
                            <!-- slider item end -->
                            <div class="slider-item">
                                <div class="card">
                                    <div class="card-body">
                                        <a href="#">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="slider-img">
                                                        <img class="img-fluid" src="http://via.placeholder.com/150x150" alt="">
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <h3 class="bold-title">
                                                        Lorem ipsum dolor sit amet.
                                                    </h3>
                                                    <p class="shadow-text">
                                                        Lorem ipsum dolor sit amet consectetur.
                                                    </p>
                                                </div>
                                                <div class="col-md-12">
                                                    <p class="book-now">
                                                        Book Now
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div> 
                            <!-- slider item end -->
                            <div class="slider-item">
                                <div class="card">
                                    <div class="card-body">
                                        <a href="#">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="slider-img">
                                                        <img class="img-fluid" src="http://via.placeholder.com/150x150" alt="">
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <h3 class="bold-title">
                                                        Lorem ipsum dolor sit amet.
                                                    </h3>
                                                    <p class="shadow-text">
                                                        Lorem ipsum dolor sit amet consectetur.
                                                    </p>
                                                </div>
                                                <div class="col-md-12">
                                                    <p class="book-now">
                                                        Book Now
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div> 
                            <!-- slider item end -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<br>
<section class="banner_ads">
    <div class="container-fluid">
        <div class="ads_place">
            <h1>Ads Here</h1>
        </div>
    </div>
</section>
<br>
<section class="super_offer">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="offer_title">Travel Blog</h2>
                    </div>
                </div>
                <br>
                <div class="row">
                    <!-- Post Item Column -->
                    <div class="col-md-3 col-sm-6">
                        <div class="card mar-top-bottom-20">
                            <a href="#" class="card_link">
                                <img src="http://via.placeholder.com/1280x800/000000/FFFFFF?text=JATRA%20APPS" alt="" class="img-fluid">
                                <div class="card-body">
                                    <p class="card-text">Some quick example text to build on the card title.</p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <!-- Post Item Column -->
                    <div class="col-md-3 col-sm-6">
                        <div class="card mar-top-bottom-20">
                            <a href="#" class="card_link">
                                <img src="http://via.placeholder.com/1280x800/000000/FFFFFF?text=JATRA%20APPS" alt="" class="img-fluid">
                                <div class="card-body">
                                    <p class="card-text">Some quick example text to build on the card title.</p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <!-- Post Item Column -->
                    <div class="col-md-3 col-sm-6">
                        <div class="card mar-top-bottom-20">
                            <a href="#" class="card_link">
                                <img src="http://via.placeholder.com/1280x800/000000/FFFFFF?text=JATRA%20APPS" alt="" class="img-fluid">
                                <div class="card-body">
                                    <p class="card-text">Some quick example text to build on the card title.</p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <!-- Post Item Column -->
                    <div class="col-md-3 col-sm-6">
                        <div class="card mar-top-bottom-20">
                            <a href="#" class="card_link">
                                <img src="http://via.placeholder.com/1280x800/000000/FFFFFF?text=JATRA%20APPS" alt="" class="img-fluid">
                                <div class="card-body">
                                    <p class="card-text">Some quick example text to build on the card title.</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<br>
<section class="banner_ads">
    <div class="container-fluid">
        <div class="ads_place">
            <h1>Ads Here</h1>
        </div>
    </div>
</section>
<br>

<footer>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-3">
                <h2 class="footer-site-title"><a href="#">JATRA</a></h2>
                <p class="footer-about">
                    Lorem ipsum dolor sit amet consectetur, adipisicing elit. Unde nisi commodi vitae quaerat iste earum sequi.
                </p>
            </div>
            <div class="col-sm-3">
                
                <ul class="footer-list">
                    <li><a href="#">Offers</a></li>
                    <li><a href="#">Travel Blogs</a></li>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Contact Us</a></li>
                    <li><a href="#">Terms of Use</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                </ul>
            </div>
            <div class="col-sm-3">
                <h2 class="footer-title">
                    Services
                </h2>
                <ul class="footer-list">
                    <li><a href="#">Bus</a></li>
                    <li><a href="#">Train</a></li>
                    <li><a href="#">Flight</a></li>
                    <li><a href="#">Cabs</a></li>
                </ul>
            </div>
            <div class="col-sm-3">
                <h2 class="footer-title">
                    Action
                </h2>
                <ul class="footer-list">
                    <li><a href="#">Login</a></li>
                    <li><a href="#">Registration</a></li>
                    <li><a href="#">Cancel Ticket</a></li>
                    <li><a href="#">Supports</a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>

<div class="modal fade" id="TicketCancelModel" tabindex="-1" role="dialog" aria-labelledby="TicketCancelModelLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-body">
        <div class="row">
            <div class="col-md-6 col">
                <h2>Cancel Ticket</h2>
            </div>
            <div class="col-md-6 col">
                
            </div>
        </div>
          <div class="row">
              <div id="cancel_one" class="cancel_ticket_area">
                  {{-- <form action="{{ route('search.cancel.ticket') }}" method="POST"> --}}
                  <form action="" id="search_ticket_for_cancel">
                      @csrf
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="ticket_no">Ticket Number</label>
                                <input type="text" id="ticket_no" name="ticket_no" class="form-control" placeholder="Ticket Number..">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button class="btn btn-success btn-block">FIND</button>
                        </div>
                  </form>
              </div>
              <div id="cancel_two" class="cancel_ticket_area">
                  <div class="col-md-12">
                    <button id="cn_op_one" class="btn btn-sm btn-info"><span class="fa fa-angle-left"></span> Back</button>
                  </div>
                  <br>
                  <form action="{{ route('website.ticket.cancel') }}" method="POST" id="apply_cancel_ticket" onsubmit="return confirm('Are you Sure?')">
                    @csrf
                    <input type="hidden" name="cn_ticket_id" id="cn_ticket_id">
                    <div class="col-md-12">
                        <table class="table">
                            <tr>
                                <td>Passenger Name</td>
                                <td>:</td>
                                <td id="cn_passenger_name"></td>
                            </tr>
                            <tr>
                                <td>Bus Operator Name</td>
                                <td>:</td>
                                <td id="cn_bus_operator"></td>
                            </tr>
                            <tr>
                                <td>Bus Route</td>
                                <td>:</td>
                                <td id="cn_bus_route"></td>
                            </tr>
                            <tr>
                                <td>Schedule</td>
                                <td>:</td>
                                <td id="cn_bus_schedule"></td>
                            </tr>
                            <tr>
                                <td>Purchased Seat(s)</td>
                                <td>:</td>
                                <td id="cn_bus_seat"></td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>:</td>
                                <td id="cn_ticket_status"></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="cn_reaon">Cancel Reason <span class="required"></span></label>
                            <textarea name="reason" id="cn_reason" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="pull-right">
                            <button type="submit" id="cn_btn" class="btn btn-success btn-sm">Apply</button>
                        </div>
                    </div>
                  </form>
              </div>
          </div>
          <br>
        </div>
      </div>
    </div>
  </div>

<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-body">
        <div class="row">
            <div class="col-md-6">
                <h2>Login</h2>
            </div>
            <div class="col-md-6">
                <p class="float-right">or <button class="btn btn-sm btn-link" data-dismiss="modal" data-toggle="modal" data-target="#signUpModal">Create an Account</button></p>
            </div>
        </div>
          <div class="row">
              <div class="col-md-12">
                  <div class="form-group">
                      <label for="email">Phone Number</label>
                      <input type="text" class="form-control" placeholder="Phone Number..">
                  </div>
              </div>
              <div class="col-md-12">
                  <div class="form-group">
                      <label for="email">Password</label>
                      <input type="password" class="form-control" placeholder="Enter Password">
                  </div>
              </div>
              <div class="col-md-12">
                  <button class="btn btn-success btn-block">LOGIN</button>
              </div>
          </div>
          <br>
          <br>
          <br>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="signUpModal" tabindex="-1" role="dialog" aria-labelledby="signUpModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-body">
        <div class="row">
            <div class="col-md-6">
                <h2>Sign Up</h2>
            </div>
            <div class="col-md-6">
                <p class="float-right">or <button class="btn btn-sm btn-link" data-dismiss="modal" data-toggle="modal" data-target="#loginModal">Have an Account?</button></p>
            </div>
        </div>
        <form action="" id="customer_register_form">
          <div class="row">
                  @csrf
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="rc_name">Name</label>
                            <input type="text" id="rc_name" name="name" class="form-control" placeholder="Enter Your Name">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="rc_phone">Phone Number</label>
                            <input type="text" id="rc_phone" name="phone" class="form-control" placeholder="Phone Number..">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="rc_password">Password</label>
                            <input type="password" id="rc_password" name="password" class="form-control" placeholder="Enter Password">
                        </div>
                    </div>

                    <div class="col-md-12">
                        <button class="btn btn-success btn-block">Sign Up</button>
                    </div>
                </div>
            </form>
          <br>
        </div>
      </div>
    </div>
  </div>

  <!-- Bus Seat Plan and Booking Modal -->
  <div class="modal fade viewSeatModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <!-- <div class="modal-header">

        </div> -->
        <div class="modal-body">
            <div class="modal-close-btn">
                <button class="" data-dismiss="modal">&times;</button>
            </div>
            <input type="hidden" data-item="charge">
            <div class="bus-ticket-process show" id="bus-step-one">
                <div class="row">
                    <div class="col-md-3">
                        <!-- Seat Layout Start Here -->
                        <div class="seat-type">
                            <p class="title">Seat Type</p>
                            <button class="btn btn-sm btn-light">Available</button>
                            <button class="btn btn-sm btn-success">Selected</button>
                            <button class="btn btn-sm btn-dark">Booked</button>
                        </div>
                        <div id="showSeats">
                            <!-- Seat Row -->
                            <div class="seat_row">
                                <!-- Seat Coloumn -->
                                <div class="seat_col"></div>
                                <div class="seat_col"></div>
                                <div class="seat_col"></div>
                                <div class="seat_col"></div>
                                <div class="seat_col"></div>
                                <div class="seat_col">
                                    <button class="btn btn-sm btn-info" disabled><span class="fa fa-chrome"></span></button>
                                </div>
                            </div>
                            <div class="seat_row">
                                <div class="seat_col">
                                    <!-- Seat Button -->
                                    <button class="btn btn-sm btn-block btn-light seat_btn" data-ticket-id="A1" title="[A1]">A1</button>
                                </div>
                                <div class="seat_col">
                                    
                                </div>
                                <div class="seat_col">
                                    
                                </div>
                                <div class="seat_col">
                                    
                                </div>
                                <div class="seat_col">
                                    <button class="btn btn-sm btn-block btn-light seat_btn" data-ticket-id="A2" title="[A2]">A2</button>
                                </div>
                                <div class="seat_col">
                                    <button class="btn btn-sm btn-block btn-light seat_btn" data-ticket-id="A3" title="[A3]">A3</button>
                                </div>
                            </div>
                            <div class="seat_row">
                                <div class="seat_col">
                                    <button class="btn btn-sm btn-block btn-light seat_btn" data-ticket-id="B1" title="[B1]">B1</button>
                                </div>
                                <div class="seat_col">
                                    <button class="btn btn-sm btn-block btn-light seat_btn" data-ticket-id="B2" title="[B2]">B2</button>
                                </div>
                                <div class="seat_col">
                                    
                                </div>
                                <div class="seat_col">
                                    
                                </div>
                                <div class="seat_col">
                                    <button class="btn btn-sm btn-block btn-light seat_btn" data-ticket-id="B3" title="[B3]">B3</button>
                                </div>
                                <div class="seat_col">
                                    <button class="btn btn-sm btn-block btn-light seat_btn" data-ticket-id="B4" title="[B4]">B4</button>
                                </div>
                            </div>
                            <div class="seat_row">
                                <div class="seat_col">
                                    <button class="btn btn-sm btn-block btn-light seat_btn" data-ticket-id="C1" title="[C1]">C1</button>
                                </div>
                                <div class="seat_col">
                                    <button class="btn btn-sm btn-block btn-light seat_btn" data-ticket-id="C2" title="[C2]">C2</button>
                                </div>
                                <div class="seat_col">
                                    
                                </div>
                                <div class="seat_col">
                                    
                                </div>
                                <div class="seat_col">
                                    <button class="btn btn-sm btn-block btn-light seat_btn" data-ticket-id="C3" title="[C3]">C3</button>
                                </div>
                                <div class="seat_col">
                                    <button class="btn btn-sm btn-block btn-light seat_btn" data-ticket-id="C4" title="[C4]">C4</button>
                                </div>
                            </div>
                            <div class="seat_row">
                                <div class="seat_col">
                                    <button class="btn btn-sm btn-block btn-light seat_btn" data-ticket-id="D1" title="[D1]">D1</button>
                                </div>
                                <div class="seat_col">
                                    <button class="btn btn-sm btn-block btn-light seat_btn" data-ticket-id="D2" title="[D2]">D2</button>
                                </div>
                                <div class="seat_col">
                                    
                                </div>
                                <div class="seat_col">
                                    
                                </div>
                                <div class="seat_col">
                                    <button class="btn btn-sm btn-block btn-light seat_btn" data-ticket-id="D3" title="[D3]">D3</button>
                                </div>
                                <div class="seat_col">
                                    <button class="btn btn-sm btn-block btn-light seat_btn" data-ticket-id="D4" title="[D4]">D4</button>
                                </div>
                            </div>
                            <div class="seat_row">
                                <div class="seat_col">
                                    <button class="btn btn-sm btn-block btn-light seat_btn" data-ticket-id="E1" title="[E1]">E1</button>
                                </div>
                                <div class="seat_col">
                                    <button class="btn btn-sm btn-block btn-light seat_btn" data-ticket-id="E2" title="[E2]">E2</button>
                                </div>
                                <div class="seat_col">
                                    
                                </div>
                                <div class="seat_col">
                                    
                                </div>
                                <div class="seat_col">
                                    <button class="btn btn-sm btn-block btn-light seat_btn" data-ticket-id="E3" title="[E3]">E3</button>
                                </div>
                                <div class="seat_col">
                                    <button class="btn btn-sm btn-block btn-light seat_btn" data-ticket-id="E4" title="[E4]">E4</button>
                                </div>
                            </div>
                            <div class="seat_row">
                                <div class="seat_col">
                                    <button class="btn btn-sm btn-block btn-light seat_btn" data-ticket-id="F1" title="[F1]">F1</button>
                                </div>
                                <div class="seat_col">
                                    <button class="btn btn-sm btn-block btn-light seat_btn" data-ticket-id="F2" title="[F2]">F2</button>
                                </div>
                                <div class="seat_col">
                                    
                                </div>
                                <div class="seat_col">
                                    
                                </div>
                                <div class="seat_col">
                                    <button class="btn btn-sm btn-block btn-light seat_btn" data-ticket-id="F3" title="[F3]">F3</button>
                                </div>
                                <div class="seat_col">
                                    <button class="btn btn-sm btn-block btn-light seat_btn" data-ticket-id="F4" title="[F4]">F4</button>
                                </div>
                            </div>
                            <div class="seat_row">
                                <div class="seat_col">
                                    <button class="btn btn-sm btn-block btn-light seat_btn" data-ticket-id="G1" title="[G1]">G1</button>
                                </div>
                                <div class="seat_col">
                                    <button class="btn btn-sm btn-block btn-light seat_btn" data-ticket-id="G2" title="[G2]">G2</button>
                                </div>
                                <div class="seat_col">
                                    
                                </div>
                                <div class="seat_col">
                                    
                                </div>
                                <div class="seat_col">
                                    <button class="btn btn-sm btn-block btn-light seat_btn" data-ticket-id="G3" title="[G3]">G3</button>
                                </div>
                                <div class="seat_col">
                                    <button class="btn btn-sm btn-block btn-light seat_btn" data-ticket-id="G4" title="[G4]">G4</button>
                                </div>
                            </div>
                            <div class="seat_row">
                                <div class="seat_col">
                                    <button class="btn btn-sm btn-block btn-light seat_btn" data-ticket-id="H1" title="[H1]">H1</button>
                                </div>
                                <div class="seat_col">
                                    <button class="btn btn-sm btn-block btn-light seat_btn" data-ticket-id="H2" title="[H2]">H2</button>
                                </div>
                                <div class="seat_col">
                                    
                                </div>
                                <div class="seat_col">
                                    
                                </div>
                                <div class="seat_col">
                                    <button class="btn btn-sm btn-block btn-light seat_btn" data-ticket-id="H3" title="[H3]">H3</button>
                                </div>
                                <div class="seat_col">
                                    <button class="btn btn-sm btn-block btn-light seat_btn" data-ticket-id="H4" title="[H4]">H4</button>
                                </div>
                            </div>
                            <div class="seat_row">
                                <div class="seat_col">
                                    <button class="btn btn-sm btn-block btn-light seat_btn" data-ticket-id="I1" title="[I1]">I1</button>
                                </div>
                                <div class="seat_col">
                                    <button class="btn btn-sm btn-block btn-light seat_btn" data-ticket-id="I2" title="[I2]">I2</button>
                                </div>
                                <div class="seat_col">
                                    
                                </div>
                                <div class="seat_col">
                                    
                                </div>
                                <div class="seat_col">
                                    <button class="btn btn-sm btn-block btn-light seat_btn" data-ticket-id="I3" title="[I3]">I3</button>
                                </div>
                                <div class="seat_col">
                                    <button class="btn btn-sm btn-block btn-light seat_btn" data-ticket-id="I4" title="[I4]">I4</button>
                                </div>
                            </div>
                            <div class="seat_row">
                                <div class="seat_col">
                                    <button class="btn btn-sm btn-block btn-light seat_btn" data-ticket-id="J1" title="[J1]">J1</button>
                                </div>
                                <div class="seat_col">
                                    <button class="btn btn-sm btn-block btn-light seat_btn" data-ticket-id="J2" title="[J2]">J2</button>
                                </div>
                                <div class="seat_col">
                                    <button class="btn btn-sm btn-block btn-light seat_btn" data-ticket-id="J3" title="[J3]">J3</button>
                                </div>
                                <div class="seat_col">
                                    <button class="btn btn-sm btn-block btn-light seat_btn" data-ticket-id="J4" title="[J4]">J4</button>
                                </div>
                                <div class="seat_col">
                                    <button class="btn btn-sm btn-block btn-light seat_btn" data-ticket-id="J5" title="[J5]">J5</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="jurney-details">
                                    <h2>Jurney Details</h2>
                                    <div class="route-name">
                                        <div class="row">
                                            <div class="col">
                                                <h1 data-city="from">Dhaka</h1>
                                            </div>
                                            <div class="col">
                                                <h1>-</h1>
                                            </div>
                                            <div class="col">
                                                <h1 data-city="to">Khulna</h1>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="datetime">Date &amp; Time: <span data-item="date">Sat, 10 Apr 2020</span>, <span data-item="time">08:00 AM</span></p>
                                    <p class="boarding-point">Boarding Point: <span data-item="boarding-point">Gabtoli</span> - <span data-item="boarding-time"></span></p>
                                </div>
                                <div class="form-group">
                                    <label for="boarding_point">Boarding Point</label>
                                    <select data-item="select-boarding" name="boarding_point" id="boarding_point" class="form-control form-control-sm">
                                        
                                    </select>
                                </div>

                                <div class="selected_seat">
                                    <p class="title">Selected Seat</p>
                                    <div class="seat_items">

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="">Charge Per Seat</label>
                                    <p class="boarding-point" id="show-charge"></p>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="float-right">
                                    <button class="btn btn-success bus_btn" id="btn-go-two" disabled>Continue</button>
                                </div>
                            </div>
                        </div>
                        <br>
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="route-map">
                                    <iframe src="https://www.google.com/maps/embed?pb=!1m64!1m12!1m3!1d936915.3452131781!2d89.46278708074293!3d23.466755681802695!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m49!3e0!4m5!1s0x3755c0f596a1ef75%3A0x1c386acb29c34356!2sGabtoli!3m2!1d23.783725699999998!2d90.34424489999999!4m5!1s0x3755ebd3d6df9569%3A0x277b3819d4da3e91!2sSavar!3m2!1d23.847879799999998!2d90.2575646!4m5!1s0x3755e9dec326c4cd%3A0xe3e8a8e36a0fee50!2sNabinagar%20Bus%20Stand%2CSavar%2C%20N5%2C%20Savar%20Union!3m2!1d23.912477!2d90.259787!4m5!1s0x39fe2534aaa4fc7f%3A0x4daf43ffdb19a28e!2sFaridpur!3m2!1d23.6018691!2d89.8333382!4m5!1s0x39fe2ab67ef4d3b9%3A0x56ba886f19dd615f!2sBhanga!3m2!1d23.3853306!2d89.98367689999999!4m5!1s0x39ffd2427e7dfdf5%3A0xd85951b4386bed00!2sMuksudpur!3m2!1d23.3197792!2d89.8668809!4m5!1s0x39ffc81f66e4bf7b%3A0xe0d7fdab679e6fa5!2sBhatiapara!3m2!1d23.212367!2d89.702771!4m5!1s0x39ffc29c3b07af57%3A0x1b95b14d7eebbcd1!2sGopalganj!3m2!1d23.0130139!2d89.8224054!5e0!3m2!1sen!2sbd!4v1585993565594!5m2!1sen!2sbd" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bus-ticket-process" id="bus-step-two">
                <form action="" id="ticket_booking_form">
                {{-- <form action="{{ route('search.bus.buy') }}" method="POST">
                    @csrf --}}
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-title">
                                <h2>Passenger Details</h2>
                            </div>
                            <div id="seat_list">
                                
                            </div>
                            <input type="hidden" id="bus_selected_date" name="bus_selected_date">
                            <input type="hidden" id="bus_schedule_no" name="bus_schedule_no">
                            <input type="hidden" id="total_seat" name="total_seat">
                            <input type="hidden" id="total_charge" name="total_charge">
                            <input type="hidden" id="boarding_point_id" name="boarding_point_id">
                            <input type="hidden" id="discount" name="discount" value="0">
                            <input type="hidden" id="service_charge" name="service_charge" value="20">
                            <input type="hidden" id="seat_charge" name="seat_charge" value="">
                            <div class="form-group">
                                <label for="name">Name <span class="required"></span></label>
                                <input type="text" class="form-control form-control-sm" id="name" name="customer_name" required>
                            </div>
                            <div class="form-group">
                                <label for="">Gender <span class="required"></span></label>
                                <br>
                                <label for="male" class="radio-inline">
                                    <input type="radio" id="male" name="gender" value="male" required>
                                    M
                                </label>
                                <label for="female" class="radio-inline">
                                    <input type="radio" id="female" name="gender" value="female" required>
                                    F
                                </label>
                            </div>
                            <div class="form-sub-title">
                                <h2>Contact Info</h2>
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone <span class="required"></span></label>
                                <input type="text" class="form-control form-control-sm" minlength="11" maxlength="11" pattern="[0-9]{11}" id="phone" name="customer_phone" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email (Optional)</label>
                                <input type="text" class="form-control form-control-sm" id="email" name="customer_email">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-title">
                                        <h2>Payment Details</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="selected_seat">
                                        <p class="title">Selected Seat</p>
                                        <div class="seat_items">
                                            
                                        </div>
                                        <div class="total-seat">Seat(s): <span></span></div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="total-charge">
                                        <p>Total Charge</p>
                                        <h3 class="text-right"><span class="total-amount">0</span>/- tk</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="price_table">
                                        <tr>
                                            <td>Ticket Price</td>
                                            <td>:</td>
                                            <td class="text-right"><span class="total-amount">0</span></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="input-group input-group-sm">
                                        <label for=""></label>
                                        <input type="text" class="form-control" placeholder="Enter Coupon Code">
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-outline-primary" type="button">Apply</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="price_table">
                                        <tr>
                                            <td>Discount</td>
                                            <td>:</td>
                                            <td class="text-right">0</td>
                                        </tr>
                                        <tr>
                                            <td>Service Charge</td>
                                            <td>:</td>
                                            <td class="text-right">20</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="">Select Payment Method</label>
                                    <div class="payment-options">
                                        <div class="method-item">
                                            <label for="method_bkash">
                                                <img src="{{ asset('website') }}/assets/images/bkash_logo.png" alt="">
                                            </label>
                                            <input type="radio" name="payment_method" id="method_bkash" value="bkash" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col">
                                    <div class="float-left">
                                        <button type="button" class="btn btn-primary bus_btn" id="btn-go-one">Back</button>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="float-right">
                                        <button type="submit" class="btn btn-success">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
    
                        </div>
                    </div>
                </form>
            </div>
            <div class="bus-ticket-process" id="bus-step-three">
                <div class="row">
                    <div class="col-md-12">
                        <div class="text-center">
                            <p>Ticket No.</p>
                            <h2 id="ticket-no"></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
<script>
    $(function(){
        var districts = [];

        $.ajax({
            url: '{{ route("location.get") }}',
            method: 'GET',
            success: function(data){
                $.each(data, function(i, d){
                    districts.push(d.name);
                })
            }
        })

        console.log(districts)

        $( "#bus_form" ).autocomplete({
            // minLength: 2,
            source: function( request, response ) {
                        var matcher = new RegExp( "^" + $.ui.autocomplete.escapeRegex( request.term ), "i" );
                        response( $.grep( districts, function( item ){
                            return matcher.test( item );
                        }) );
                    }
        });
        $( "#bus_to" ).autocomplete({
            source: function( request, response ) {
                        var matcher = new RegExp( "^" + $.ui.autocomplete.escapeRegex( request.term ), "i" );
                        response( $.grep( districts, function( item ){
                            return matcher.test( item );
                        }) );
                    }
        });
    });
    </script>
    @include('website.index.bus')
@endpush