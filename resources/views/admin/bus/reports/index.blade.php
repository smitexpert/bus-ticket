@extends('admin.layout.main')
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
        var dataTable = $("#table").DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('admin.bus.report.get') }}",
                data: function(d){
                    d.from_date = $("#from_date").val(),
                    d.to_date = $("#to_date").val(),
                    d.organization = $("#organization").val()
                }
            },
            columns: [
                {data: 'date', name: 'date'},
                {data: 'operator', name: 'operator'},
                {data: 'booked', name: 'booked'},
                {data: 'route', name: 'route'},
                {data: 'sold', name: 'sold'},
                {data: 'status', name: 'status'},
                {data: 'action', name: 'action'},
                ],
                order:[0,'desc']
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

            $("#organization").change(function(){
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
                    <h4 class="panel-title">Route List <div class="pull-right"><button class="btn btn-success btn-rounded" data-toggle="modal" data-target="#createModal"><span class="fa fa-plus"></span> Route Counter</button></div></h4>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-4">
                            
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="organization">Operator</label>
                                <select name="organization" id="organization" class="form-control selectpicker">
                                    <option value=""></option>
                                    @foreach ($organizations as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="date">Date</label>
                            <input type="text" name="date" class="form-control" id="date">
                            <input type="hidden" name="from_date" id="from_date">
                            <input type="hidden" name="to_date" id="to_date">
                        </div>
                    </div>
                    <table class="table" id="table">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Operator</th>
                                <th>Booked</th>
                                <th>Route</th>
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