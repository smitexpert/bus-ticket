@extends('agent.layout.counter')
@push('styles')
    <link href="{{ asset("backend") }}/assets/plugins/datatables/css/jquery.datatables.min.css" rel="stylesheet">
    <link href="{{ asset("backend") }}/assets/plugins/datatables/css/jquery.datatables_themeroller.css" rel="stylesheet">
    <link href="{{ asset("backend") }}/assets/plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('website') }}/assets/css/flatpickr.min.css">
@endpush
@push('scripts')
    <script src="{{ asset("backend") }}/assets/plugins/datatables/js/jquery.datatables.min.js"></script>
    <script src="{{ asset("backend") }}/assets/plugins/bootstrap-select/js/bootstrap-select.min.js"></script>
    <script src="{{ asset("website") }}/assets/js/flatpickr.js"></script>
    <script>
        $("#date").flatpickr({
            altInput: true,
            altFormat: "F j, Y",
            dateFormat: "Y-m-d",
            minDate: "today",
            defaultDate: "today"
        })
    </script>
@endpush
@section('content')
    <div class="container">
        <form action="{{ route('counter.sell.ticket.search') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="route">Select Route</label>
                        <select name="route" id="route" class="form-control form-control-sm selectpicker" data-live-search="true" required>
                            <option value="">Select</option>
                            @foreach ($routes as $item)
                                <option value="{{ $item->id }}">{{ $item->from_city->name }}-{{ $item->to_city->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="date">Select Date</label>
                        <input type="text" name="date" id="date" class="form-control form-control-sm" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div style="margin-top:32px"></div>
                    <button class="btn btn-sm btn-success">Submit</button>
                </div>
            </div>
        </form>
        <div class="row">
            <div class="col-md-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Info</th>
                            <th class="text-center">Seat Available</th>
                            <th class="text-center">Charge</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($schedules as $item)
                            <tr>
                                <td>
                                    <h4>{{ date("H:i A", strtotime($item->dep_time)) }}</h4>
                                    {{-- <h6>From-TO</h6> --}}
                                    <p><strong>{{ $item->bus->clases->name }}</strong></p>
                                </td>
                                @php
                                    $seat_booked = 0;
                                @endphp
                                @foreach ($item->tickets as $ticket)
                                    @php
                                        $seat_booked += $ticket->ticket_seat_count
                                    @endphp
                                @endforeach
                                <td class="text-center">{{ $item->total_seat - $seat_booked }}</td>
                                <td class="text-center">{{ $item->charge }}</td>
                                <td class="text-right">
                                    <div class="btn-group">
                                        <a href="{{ route('counter.sell.ticket.sell', ['id' => $item->id, 'date' => $date]) }}" class="btn btn-sm btn-info"><span class="fa fa-search"></span></a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection