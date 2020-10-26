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
        <div class="col-md-6">
            <div class="panel panel-white">
                <div class="panel-header">
                    <h4 class="panel-title">Seat Plan List</h4>
                </div>
                <div class="panel-body">
                    <table class="table table-responsive">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Seat Type</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach ($types as $item)
                              <tr>
                                  <th>{{ $loop->index+1 }}</th>
                                  <td>{{ $item->type }}</td>
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
                                <th>Seat Type</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-white">
                <div class="panel-header">
                    <h4 class="panel-title">Create Seat Plan</h4>
                </div>
                <div class="panel-body">
                    <form action="{{ route('admin.bus.seatplan.create') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="type">Type</label>
                            <input type="text" id="type" name="type" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <div class="pull-right">
                                <button class="btn btn-success">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        
    </div>
@endsection