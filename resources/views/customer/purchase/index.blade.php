@extends('customer.layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Purchase History
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Route</th>
                                    <th>Bus Operator</th>
                                    <th>Boarding Point</th>
                                    <th>Dep. Time</th>
                                    <th>Seat(s)</th>
                                    <th>Total Charge</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tickets as $item)
                                    <tr>
                                        <td>{{ $item->schedule->route->from_city->name }}-{{ $item->schedule->route->to_city->name }}</td>
                                        <td>{{ $item->schedule->organization->name }}</td>
                                        <td>{{ $item->boarding->counter->name }}</td>
                                        <td>{{ $item->boarding->arr_time }}</td>
                                        <td>
                                            @foreach ($item->ticket_seat as $seat)
                                                {{ $seat->seat_id }},
                                            @endforeach
                                        </td>
                                        <td>{{ $item->transection->total }}</td>
                                        <td>{{ $item->status }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="float-right">
                            {{ $tickets->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection