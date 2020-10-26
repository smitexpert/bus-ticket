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
                    <h4 class="panel-title">Agent List <div class="pull-right"><button class="btn btn-success btn-rounded" data-toggle="modal" data-target="#createModal"><span class="fa fa-plus"></span> Create Agent</button></div></h4>
                </div>
                <div class="panel-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($agents as $item)
                                <tr>
                                    <th>{{ $loop->index+1 }}</th>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->phone }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="#" class="btn btn-sm btn-primary"><span class="fa fa-gear"></span></a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Email</th>
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
                <h4 class="modal-title" id="createModalLabel">Create Agent</h4>
            </div>
            <div class="modal-body">
                <form method="POST" enctype="multipart/form-data" action="{{ route('agent.manage.create') }}">
                    @csrf
                    <div class="form-group">
                        <label for="name" class="control-label">Agent Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="phone" class="control-label">Phone No.</label>
                        <input type="text" class="form-control" id="phone" name="phone" minlength="11" maxlength="11" pattern="[0-9]{11}" required>
                    </div>
                    <div class="form-group">
                        <label for="email" class="control-label">Email (Optional)</label>
                        <input type="email" class="form-control" id="email" name="email" value="">
                    </div>  
                    <div class="form-group">
                        <label for="role">Select Role</label>
                        <select name="role" id="role" class="form-control">
                            <option value="">Select</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>              
                    <div class="form-group">
                        <label for="password" class="control-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" value="{{ Str::random(8) }}" required>
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