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
@include('agent.partial.alert')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-white">
                <div class="panel-header">
                    <h4 class="panel-title">Bus List <div class="pull-right"><a href="{{ route('agent.buses.create') }}" class="btn btn-success btn-rounded"><span class="fa fa-plus"></span> Create Bus</a></div></h4>
                </div>
                <div class="panel-body">
                    <table class="table table-responsive">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Seat Plan</th>
                                <th>Class</th>
                                <th>Model</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach ($buses as $item)
                              <tr>
                                  <th>{{ $loop->index+1 }}</th>
                                  <td>{{ $item->seatplan->type }}</td>
                                  <td>{{ $item->clases->name }}</td>
                                  <td>{{ $item->model }}</td>
                                  <td>
                                    <div class="pull-right">
                                        <div class="btn-group">
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
                                <th>Seat Plan</th>
                                <th>Class</th>
                                <th>Model</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

{{-- <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="createModalLabel">Create Counter</h4>
        </div>
        <div class="modal-body">
            <form method="POST" enctype="multipart/form-data" action="{{ route('admin.bus.counter.create') }}">
                @csrf
                <div class="form-group">
                    <label for="operator" class="control-label">Operator Name</label>
                    <select name="operator" id="operator" class="form-control selectpicker" data-live-search="true" required>
                        <option value="">Select Operator</option>
                        @foreach (\App\BusOrganization::all() as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="agent" class="control-label">Agent Name</label>
                    <select name="agent" id="agent" class="form-control selectpicker" data-live-search="true" required>
                        <option value="">Select Agent</option>
                        <option value="1">Select One</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="counter" class="control-label">Counter Name</label>
                    <input type="text" class="form-control" id="counter" name="counter" required>
                </div>              
                <div class="form-group">
                    <div class="pull-right">
                        <button class="btn btn-sm btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
        </div>
        </div>
    </div>
</div> --}}
@endsection