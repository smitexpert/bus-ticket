@extends('admin.layout.main')
@push('styles')
    <link href="{{ asset("backend") }}/assets/plugins/datatables/css/jquery.datatables.min.css" rel="stylesheet">
    <link href="{{ asset("backend") }}/assets/plugins/datatables/css/jquery.datatables_themeroller.css" rel="stylesheet">
@endpush
@section('content')
@include('admin.partial.alert')
<div class="col-md-12">
    <div class="panel panel-white">
        <div class="panel-heading clearfix">
            <h4 class="panel-title">Basic example <div class="pull-right"><button class="btn btn-success btn-rounded" data-toggle="modal" data-target="#createModal"><span class="fa fa-plus"></span> Create Organization</button></div></h4>
        </div>
        <br>
        <div class="panel-body">
           <div class="table-responsive">
            <table id="bus-organization" class="display table" style="width: 100%; cellspacing: 0;">
                <thead>
                    <tr>
                        <th>Logo</th>
                        <th>Operator Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($organizations as $item)
                        <tr>
                            <td><img style="width: 60px; height:auto" src="{{ asset('uploaded/organizations/bus/operators') }}/{{ $item->logo }}" alt=""></td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->phone }}</td>
                            <td>{{ $item->email }}</td>
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
                        <th>Logo</th>
                        <th>Operator Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                   
                </tbody>
               </table>  
            </div>
        </div>
    </div>


<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="createModalLabel">Create Organization</h4>
        </div>
        <div class="modal-body">
            <form method="POST" enctype="multipart/form-data" action="{{ route('admin.bus.organization.create') }}">
                @csrf
                <div class="form-group">
                    <label for="name" class="control-label">Operator Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="phone" class="control-label">Phone No.</label>
                    <input type="text" class="form-control" id="phone" name="phone" minlength="11" maxlength="11" pattern="[0-9]{11}" required>
                </div>
                <div class="form-group">
                    <label for="email" class="control-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="logo" class="control-label">Upload Logo</label>
                    <input type="file" class="form-control" id="logo" name="logo">
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
@push('scripts')
    <script src="{{ asset("backend") }}/assets/plugins/datatables/js/jquery.datatables.min.js"></script>
    <script>
        
        $("#bus-organization").dataTable();
    </script>
@endpush