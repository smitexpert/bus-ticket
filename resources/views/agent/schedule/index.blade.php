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
        $("#table").dataTable();

        
        

        $("#busmodel").change(function(){
            
            var seatplan_uri = "{{ route('agent.schedules.seatplan') }}";

            var id = $(this).find(":selected").val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            
            $.ajax({
                url: seatplan_uri,
                data: {
                    id: id
                },
                method: "POST",
                success: function(data){
                   $("#seatplan").val(data.seatplan.type)
                   $("#seatplan_id").val(data.seatplan.id)
                }
            });
        })

        $(".modal-view-btn").click(function(){
            $(".modal-view").removeClass('show');
            var view = $(this).attr('id');
            view = view.replace("_btn", "");
            $("#"+view).addClass("show");
        })

        // $(".close_bording").click(function(){
        //     console.log("Working");
            
        // })

        function close_bording(id){
            $("#"+id).remove();
        }

        $("#boarding").change(function(){
            var id = $(this).find(":selected").val();
            var name = $(this).find(":selected").text();
            if(id != ""){
                $(".table-custom tbody").append('<tr id="'+id+'"><td>'+name+' <input type="hidden" name="counter[]" value="'+id+'"></td><td><input type="time" name="c_arr_time[]" required></td><td><button type="button" onclick="close_bording('+id+')" class="close_bording">X</button></td></tr>');
            }
        })

    </script>
@endpush
@section('content')
@include('agent.partial.alert')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-white">
                <div class="panel-header">
                    <h4 class="panel-title">Schedule List <div class="pull-right"><button class="btn btn-success btn-rounded" data-toggle="modal" data-target="#createModal"><span class="fa fa-plus"></span> Create Schedule</button></div></h4>
                </div>
                <div class="panel-body">
                    <table class="table table-responsive" id="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Route</th>
                                <th>Coach</th>
                                <th>Charge</th>
                                <th>Dep. Time</th>
                                <th>Arr. Time</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                           @foreach ($schedules as $item)
                               <tr>
                                   <th>{{ $loop->index+1 }}</th>
                                   <td>{{ $item->route->from_city->name }}-{{ $item->route->to_city->name }}</td>
                                   <td>{{ $item->coach }}</td>
                                   <td>{{ $item->charge }}</td>
                                   <td>{{ date('h:i A', strtotime($item->dep_time)) }}</td>
                                   <td>{{ date('h:i A', strtotime($item->arr_time)) }}</td>
                                   <td>
                                    <div class="pull-right">
                                        <div class="btn-group">
                                            <a href="#" class="btn btn-sm btn-info"><span class="fa fa-search"></span></a>
                                            <a href="#" class="btn btn-sm btn-primary">Edit</a>
                                            <a href="#" class="btn btn-sm btn-danger">Del</a>
                                        </div>
                                    </div>
                                   </td>
                               </tr>
                           @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Route</th>
                                <th>Coach</th>
                                <th>Charge</th>
                                <th>Dep. Time</th>
                                <th>Arr. Time</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="createModalLabel">Create Bus Schedule</h4>
        </div>
        <div class="modal-body">
            <form method="POST" enctype="multipart/form-data" action="{{ route('agent.schedules.create') }}">
            <div class="modal-view show" id="one">
                    @csrf
                    <input type="hidden" name="operator" id="operator" value="{{ auth('agent')->user()->bus_organizations_id }}">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="route" class="control-label">Route Name</label>
                                <select name="route" id="route" class="form-control selectpicker" data-live-search="true" required>
                                    <option value="">Select Route</option>
                                    @foreach (\App\BusRoute::where('bus_organization_id', auth('agent')->user()->bus_organizations_id)->get() as $item)
                                        <option value="{{ $item->id }}">{{ $item->from_city->name }}-{{ $item->to_city->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="coach" class="control-label">Coach Number</label>
                                <input type="text" class="form-control" id="coach" name="coach" required>
                            </div>
                            <div class="form-group">
                                <label for="agent" class="control-label">Agent Name</label>
                                <select name="agent" id="agent" class="form-control selectpicker" data-live-search="true">
                                    <option value="">Select Agent</option>
                                    @foreach (\App\Agent::where('bus_organizations_id', auth('agent')->user()->bus_organizations_id)->get() as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="charge" class="control-label">Far Charge</label>
                                <input type="text" class="form-control" id="charge" name="charge" required>
                            </div> 
                            <div class="form-group">
                                <label for="bus_number" class="control-label">Bus Number</label>
                                <input type="text" class="form-control" id="bus_number" name="bus_number">
                            </div> 
                            <div class="form-group">
                                <label for="busmodel" class="control-label">Bus Model</label>
                                <select name="busmodel" id="busmodel" class="form-control selectpicker" data-live-search="true" required>
                                    <option value="">Select Model</option>
                                    @foreach (\App\Bus::where('bus_organization_id', auth('agent')->user()->bus_organizations_id)->get() as $item)
                                        <option value="{{ $item->id }}">{{ $item->model }}</option>
                                    @endforeach
                                </select>
                            </div>  
                        </div>
                        <div class="col-md-6">            
                            <div class="form-group">
                                <label for="seatplan" class="control-label">Seat Plan</label>
                                <input type="text" class="form-control" id="seatplan" name="seatplan" required readonly>
                                <input type="hidden" class="form-control" id="seatplan_id" name="seatplan_id" >
                            </div>              
                            <div class="form-group">
                                <label for="total_seat" class="control-label">Total Seat</label>
                                <input type="number" class="form-control" id="total_seat" name="total_seat" min="0" required>
                            </div>              
                            <div class="form-group">
                                <label for="limit" class="control-label">Booking Limit</label>
                                <input type="number" class="form-control" id="limit" name="limit" min="0" value="0" required>
                            </div>
                            <div class="form-group">
                                <label for="dep_time" class="control-label">Dep. Time</label>
                                <input type="time" class="form-control" id="dep_time" name="dep_time" required>
                            </div>
                            <div class="form-group">
                                <label for="arr_time" class="control-label">Arr. Time</label>
                                <input type="time" class="form-control" id="arr_time" name="arr_time" required>
                            </div>
                            <div class="form-group">
                                <div class="pull-right">
                                    <button type="button" id="two_btn" class="btn btn-sm btn-primary modal-view-btn">Next <span class="fa fa-angle-right"></span></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-view" id="two">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="boarding">Select Bording Point</label>
                                <select name="boarding" id="boarding" class="form-control selectpicker" data-live-search="true" required>
                                    <option value="">Select</option>
                                    @foreach (\App\BusCounter::where('bus_organizations_id', auth('agent')->user()->bus_organizations_id)->get() as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Selected Bording Point</label>
                                <table class="table-custom">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Time</th>
                                            <th>X</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="pull-left">
                                <button type="button" id="one_btn" class="btn btn-sm btn-primary modal-view-btn"><span class="fa fa-angle-left"></span> Prev</button>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="pull-right">
                                <button type="submit" id="submit_btn" class="btn btn-sm btn-success">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
        </div>
        </div>
    </div>
</div>
@endsection