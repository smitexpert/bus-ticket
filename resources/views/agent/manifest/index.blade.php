@extends('agent.layout.main')
@push('styles')
    <link href="{{ asset("backend") }}/assets/plugins/datatables/css/jquery.datatables.min.css" rel="stylesheet">
    <link href="{{ asset("backend") }}/assets/plugins/datatables/css/jquery.datatables_themeroller.css" rel="stylesheet">
    <link href="{{ asset("backend") }}/assets/plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet">
@endpush
@push('scripts')
    <script src="{{ asset("backend") }}/assets/plugins/datatables/js/jquery.datatables.min.js"></script>
    <script src="{{ asset("backend") }}/assets/plugins/bootstrap-select/js/bootstrap-select.min.js"></script>
    <script>
        $(".table").dataTable();
    </script>
@endpush
@section('content')
@include('admin.partial.alert')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-white">
                <div class="panel-header">
                    <h4 class="panel-title">Today Schedules</h4>
                </div>
                <div class="panel-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Dep. Time</th>
                                <th>Route</th>
                                <th>Coach No.</th>
                                <th>Seat Boocked</th>
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
@endsection