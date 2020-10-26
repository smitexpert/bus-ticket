<section class="navigation">
    <nav>
        <div class="container-fluid">
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
                        <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#loginModal">Login</button>
                        <button class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#signUpModal">Sign Up</button>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</section>
<br>