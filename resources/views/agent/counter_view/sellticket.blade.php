@extends('agent.layout.counter')
@push('styles')
    <style>
        .loading {
    display: none;
    position: fixed;
    width: 100%;
    height: 100vh;
    background-color: rgba(000, 000, 000, 0.2);
    top: 0;
    z-index: 999999;
    align-items: center;
    justify-content: center;
}

.loading.show {
    display: flex;
}

.loading img {
    width: 100px;
    height: 100px;
}

        #showSeats {
    width: 100%;
    height: auto;
    border: 1px solid #cccccc;
    margin: 20px 0;
    padding: 10px;
}

#showSeats #frontSide {
    display: flex;
    justify-content: space-around;
}

#showSeats #frontSide .ec-item .btn {
    margin: 2px 0;
}

#showSeats .seat_row {
    display: flex;
    justify-content: space-between;
    margin: 10px 0;
}

#showSeats .seat_row .seat_col {
    width: 80px;
    margin: 0 2px;
}
    </style>
@endpush
@section('content')
<div class="loading show">
    <img src="{{ asset('/') }}/loading.gif" alt="">
</div>
    <div class="container">
        <div class="row">
            <div class="col-md-4">

                <div class="row">
                    <div class="col-md-12">
                        <div class="float-left">
                            <a href="{{ route('counter.sell.ticket') }}" class="btn btn-sm btn-success"><span class="fa fa-angle-left"></span> Back</a>
                        </div>
                    </div>
                </div>

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
            <div class="col-md-4"></div>
            <div class="col-md-4">
            <h1>{{ $result->route->from_city->name }}-{{ $result->route->to_city->name }}</h1>
                <h4>{{ $result->bus->clases->name }} - Dep. Time: {{ date("H:i A", strtotime($result->dep_time)) }}</h4>
                <hr>
                <form action="{{ route('counter.sell.ticket.sell.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="schedule" id="schedule" value="{{ $result->id }}">
                    <div id="add_seat">
                    </div>
                    <div class="form-group">
                        <label for="date">Selected Date</label>
                        <input type="date" name="date" id="date" value="{{ $date }}" class="form-control form-control-sm" readonly>
                    </div>
                    <div class="form-group">
                        <label for="counter">Selected Counter</label>
                        <select name="counter" id="counter" class="form-control form-control-sm">
                            @foreach ($counter as $item)
                                <option value="{{ $item->boarding->id }}">{{ $item->name }} at {{ $item->boarding->arr_time }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="customer_name">Customer Name</label>
                        <input type="text" name="customer_name" id="customer_name" class="form-control form-control-sm">
                    </div>
                    <div class="form-group">
                        <label for="customer_mobile">Customer Mobile</label>
                        <input type="text" minlength="11" maxlength="11" pattern="[0-9]{11}" name="customer_mobile" id="customer_mobile" class="form-control form-control-sm">
                    </div>
                    <div class="form-group">
                        <label for="customer_mobile">Gender</label>
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
                    <div class="form-group">
                        <label for="seat_charge">Seat Charge</label>
                        <input type="text" name="seat_charge" id="seat_charge" class="form-control form-control-sm text-right seat_charge" value="{{ $result->charge }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="selected_seat_show">Selected Seat</label>
                        <input type="text" name="" id="selected_seat_show" class="form-control form-control-sm" readonly>
                    </div>
                    <div class="form-group">
                        <label for="total_charge">Total Charge</label>
                        <input type="text" name="total_charge" id="total_charge" class="form-control form-control-sm text-right total_charge" value="0" readonly>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success float-right submit_btn" disabled>Submit</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    @include('agent.counter_view.script')
@endpush