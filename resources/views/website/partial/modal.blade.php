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
                  <form action="" id="apply_cancel_ticket">
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
                        </table>
                    </div>
                    <div class="col-md-12">
                        <div class="pull-right">
                            <button type="submit" class="btn btn-success btn-sm">Apply</button>
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
                <p class="float-right">or <a href="#">Create an Account</a></p>
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
                <h2>Login</h2>
            </div>
            <div class="col-md-6">
                <p class="float-right">or <a href="#">Have an Account?</a></p>
            </div>
        </div>
          <div class="row">
              <div class="col-md-12">
                  <div class="form-group">
                      <label for="Name">Name</label>
                      <input type="text" class="form-control" placeholder="Enter Your Name">
                  </div>
              </div>
              <div class="col-md-12">
                  <div class="form-group">
                      <label for="phone">Phone Number</label>
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
                  <button class="btn btn-success btn-block">Sign Up</button>
              </div>
          </div>
          <br>
        </div>
      </div>
    </div>
  </div>