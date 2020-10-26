@extends('agent.layout.main')
@push('styles')
    <link href="{{ asset("backend") }}/assets/plugins/datatables/css/jquery.datatables.min.css" rel="stylesheet">
    <link href="{{ asset("backend") }}/assets/plugins/datatables/css/jquery.datatables_themeroller.css" rel="stylesheet">
    <link href="{{ asset("backend") }}/assets/plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet">
    <link href="{{ asset("website") }}/assets/css/flatpickr.min.css" rel="stylesheet">
@endpush
@push('scripts')
    <script src="{{ asset("backend") }}/assets/plugins/datatables/js/jquery.datatables.min.js"></script>
    <script src="{{ asset("backend") }}/assets/plugins/bootstrap-select/js/bootstrap-select.min.js"></script>
    <script src="{{ asset("backend") }}/assets/plugins/bootstrap-select/js/bootstrap-select.min.js"></script>
    <script src="{{ asset("website") }}/assets/js/flatpickr.js"></script>
    <script>
        // $(".table").dataTable();
        var dataTable = $("#table").DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('agent.reports.get') }}",
                data: function(d){
                    d.from_date = $("#from_date").val(),
                    d.to_date = $("#to_date").val(),
                    d.route = $("#route").val()
                }
            },
            columns: [
                {data: 'date', name: 'date'},
                {data: 'booked', name: 'booked'},
                {data: 'route', name: 'route'},
                {data: 'coach', name: 'coach'},
                {data: 'sold', name: 'sold'},
                {data: 'status', name: 'status'},
                {data: 'action', name: 'action'},
                ]
            });

            $("#date").flatpickr({
                mode: "range",
                dateFormat: "Y-m-d",
            });

            $("#date").change(function(){
                var date = $(this).val();
                date = date.replace(' to ', ',');
                date = date.split(',');
                if(date.length == 1)
                {
                    $("#from_date").val(date[0]);
                    $("#to_date").val('');
                }else{
                    $("#from_date").val(date[0]);
                    $("#to_date").val(date[1]);
                }

                dataTable.draw();
            })

            $("#route").change(function(){
                dataTable.draw();
            })

            
            
    </script>
@endpush
@section('content')
@include('admin.partial.alert')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-white">
                <div class="panel-header">
                    <h4 class="panel-title">Reports</h4>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-4">
                            
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="route">Select Route</label>
                                <select name="route" id="route" class="from-control selectpicker" data-live-search="true">
                                    <option value=""></option>
                                    @foreach ($routes as $item)
                                        <option value="{{ $item->id }}">{{ $item->from_city->name }}-{{ $item->to_city->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="date">Date Range</label>
                                <input type="text" class="form-control" id="date" name="date">
                                <input type="hidden" name="from_date" id="from_date">
                                <input type="hidden" name="to_date" id="to_date">
                            </div>
                        </div>
                    </div>
                    <table class="table" id="table">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Booked</th>
                                <th>Route</th>
                                <th>Coach</th>
                                <th>Sold</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection