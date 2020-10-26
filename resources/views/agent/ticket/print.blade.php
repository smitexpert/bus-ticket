<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!-- Styles -->
    {{-- <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet"> --}}
    {{-- <link href="{{ asset("backend") }}/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet"> --}}<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <style>
        .print_view {
            width: 796px;
            /* border: 1px solid #000000; */
            margin: 0 auto;
        }

        .ticket-header {
            width: 100%;
            background-color: #f9f2f4;
        }

        .ticket-header td {
            width: 50%;
            padding: 0 10px;
        }

        .ticket-header td img {
            text-align: center;
            width: 120px;
            max-height: 80px;
        }

        .ticket-header .img {
            text-align: center;
        }

        .ticket-header .ticket-id {
            font-size: 24px;
        }

        .info_table {
            background-color: #f9f2f4;
            margin: 3px 0;
        }

        .info_table td {
            padding: 8px 5px;
            font-size: 12px;
            width: 10px;
        }

        .info_table td:first-child{
            width: 32%;
        }

        .info_table td:last-child {
            width: 65%;
        }

        .address {
            width: 100%;
            background-color: #f9f2f4;
            font-size: 12px;
            color: #666666;
            padding: 5px;
            margin: 5px 0;
        }

        .result-view {
            width: 100%;
            min-height: 120px;
        }

        .seat_ticket_table {
            width: 100%;
        }

        .seat_ticket_table thead {
            background-color: #f9f2f4;
        }

        .seat_ticket_table th,
        .seat_ticket_table td {
            font-size: 12px;
            font-weight: bold;
            padding: 3px;
        }

        .seat_ticket_table thead th:last-child {
            width: 300px;
            text-align: right;
        }

        .seat_ticket_table tbody td:last-child {
            width: 300px;
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="">
            <div class="row">
                <div class="col-sm-12">
                    <table class="ticket-header">
                        <tr>
                            <td class="ticket-id">Ticket No: <strong><code>123456</code></strong></td>
                            <td class="img">
                                <img src="{{ asset('/') }}uploaded/organizations/bus/operators/bus_default_logo.png" alt="">
                                {{-- <img src="{{ public_path() . '/uploaded/organizations/bus/operators' }}/bus_default_logo.png" alt=""> --}}
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-5">
                    <table class="info_table">
                        <tr>
                            <td>COACH NO</td>
                            <td>:</td>
                            <td>{{ $result->schedule->coach }}</td>
                        </tr>
                    </table>
                    <table class="info_table">
                        <tr>
                            <td>ROUTE</td>
                            <td>:</td>
                            <td>{{ $result->schedule->route->from_city->name }}-{{ $result->schedule->route->to_city->name }}</td>
                        </tr>
                    </table>
                    <table class="info_table">
                        <tr>
                            <td>JOURNEY DATE</td>
                            <td>:</td>
                            <td>{{ date('d-m-Y', strtotime($result->date)) }}</td>
                        </tr>
                    </table>
                    <table class="info_table">
                        <tr>
                            <td>ISSUE DATE</td>
                            <td>:</td>
                            <td>{{ date('d-m-Y', strtotime($result->created_at)) }}</td>
                        </tr>
                    </table>
                    <table class="info_table">
                        <tr>
                            <td>DEPATURE</td>
                            <td>:</td>
                            <td>{{ $result->boarding->arr_time }}</td>
                        </tr>
                    </table>
                    {{-- <table class="info_table">
                        <tr>
                            <td>REPORTING</td>
                            <td>:</td>
                            <td></td>
                        </tr> --}}
                    </table>
                    <table class="info_table">
                        <tr>
                            <td>BOARDING</td>
                            <td>:</td>
                            <td>{{ $result->boarding->counter->name }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-sm-7">
                    <div class="address">
                        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Illum nemo eius beatae magni quibusdam aliquam.
                    </div>

                    <div class="result-view">
                        <table class="seat_ticket_table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>SEAT</th>
                                    <th>FARE CHARGE</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($result->ticket_seat as $item)
                                    <tr>
                                        <td>{{ $loop->index+1 }}</td>
                                        <td>{{ $item->seat_id }}</td>
                                        <td>{{ $result->seat_charge }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td style="text-align:right; width: 78%;" colspan="2">Total:</td>
                                    <td style="text-align: right">{{ $result->transection->total }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>