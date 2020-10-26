@extends('admin.layout.main')
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
                    <h4 class="panel-title">Route List <div class="pull-right"><button class="btn btn-success btn-rounded" data-toggle="modal" data-target="#createModal"><span class="fa fa-plus"></span> Route Counter</button></div></h4>
                </div>
                <div class="panel-body">
                    <table class="table table-responsive">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Route Name</th>
                                <th>Operator Name</th>
                                <th>From City</th>
                                <th>To City</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach ($routes as $item)
                              <tr>
                                  <th>{{ $loop->index+1 }}</th>
                                  <td>{{ $item->from_city->name }} to {{ $item->to_city->name }}</td>
                                  <td>{{ $item->organization->name }}</td>
                                  <td>{{ $item->from_city->name }}</td>
                                  <td>{{ $item->to_city->name }}</td>
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
                                <th>Route Name</th>
                                <th>Operator Name</th>
                                <th>From City</th>
                                <th>To City</th>
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
            <h4 class="modal-title" id="createModalLabel">Create Counter</h4>
        </div>
        <div class="modal-body">
            <form method="POST" enctype="multipart/form-data" action="{{ route('admin.bus.routes.create') }}">
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
                    <label for="from" class="control-label">From</label>
                    <select name="from" id="from" class="form-control selectpicker" data-live-search="true" required>
                        <option value="">Select District</option>
                        @foreach (\App\District::all() as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="to" class="control-label">To</label>
                    <select name="to" id="to" class="form-control selectpicker" data-live-search="true" required>
                        <option value="">Select District</option>
                        @foreach (\App\District::all() as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
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
</div>
@endsection