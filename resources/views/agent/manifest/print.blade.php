<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print Manifest</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>
<body>
    <div class="row">
        <div class="col-md-12">
            <h4 class="text-center">{{ $manifest->route->from_city->name }}-{{ $manifest->route->to_city->name }}</h4>
            <h5 class="text-center">Dep. Time: {{ date("H:i A", strtotime($manifest->dep_time)) }}</h5>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="float-left">
                @php
                    $booked = 0;
                @endphp
                @foreach ($manifest->tickets as $item)
                    @php
                        $booked += $item->total_seat;
                    @endphp
                @endforeach
                Total Booked: {{ $booked }}
            </div>
        </div>
        <div class="col">
            <p class="text-center">Date: {{ date('d-m-Y') }}</p>
        </div>
        <div class="col">
            <div class="float-right">
                Total Seat: {{ $manifest->total_seat }}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <thead class="table-dark">
                    <tr>
                        <th>Ticket No.</th>
                        <th>Booked Seat</th>
                        <th>Customer Name</th>
                        <th>Customer Phone</th>
                        <th>Boarding Point</th>
                        <th>Remarks</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($manifest->tickets as $ticket)
                        <tr>
                            <td><strong>{{ $ticket->ticket_no }}</strong></td>
                            <td>{{ $ticket->ticket_seat->pluck('seat_id') }}</td>
                            <td>{{ $ticket->customer_name }}</td>
                            <td>{{ $ticket->customer_phone }}</td>
                            {{-- <td>
                                @foreach ($ticket->ticket_seat as $item)
                                    {{ $item->seat_id }}
                                @endforeach
                            </td> --}}
                            <td>{{ $ticket->boarding->counter->name }} at {{ date('H:i A', strtotime($ticket->boarding->arr_time)) }}</td>
                            <td></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>