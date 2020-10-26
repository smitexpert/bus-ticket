@extends('agent.layout.counter')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Today's Schedule
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Dep. Time</th>
                                    <th>Route</th>
                                    <th>Coach No.</th>
                                    <th>Seat Boocked</th>
                                    <th>Seat Available</th>
                                    <th>Details View</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($schedules as $item)
                                    <tr>
                                        <td>{{ date('H:i A', strtotime($item->dep_time)) }}</td>
                                        <td>{{ $item->route->from_city->name }}-{{ $item->route->to_city->name }}</td>
                                        <td>{{ $item->coach }}</td>
                                        @php
                                            $booked = 0;
                                        @endphp
                                        @foreach ($item->tickets as $ticket)
                                            @php
                                                $booked += $ticket->total_seat;
                                            @endphp
                                        @endforeach
                                        <td>{{ $booked }}</td>
                                        <td>{{ $item->total_seat - $booked }}</td>
                                        <td>
                                            <a href="{{ route('agent.manifest.view', ['id' => $item->id]) }}" class="btn btn-sm btn-primary"><span class="fa fa-print"></span> View Print</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection