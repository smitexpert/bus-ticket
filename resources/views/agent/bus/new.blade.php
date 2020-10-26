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
                    <h4 class="panel-title">Create Bus <div class="pull-right"><a href="{{ route('agent.buses.get') }}" class="btn btn-success btn-rounded"><span class="fa fa-angle-left"></span> Back</a></div></h4>
                </div>
                <div class="panel-body">
                    <form action="{{ route('agent.buses.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="model">Bus Model</label>
                                    <input type="text" name="model" class="form-control" id="model" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="class">Bus Class</label>
                                    <select name="class" id="class" class="form-control" required>
                                        <option value="">Select Class</option>
                                        <option value="1">Non AC</option>
                                        <option value="2">AC</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="seatplan">Seat Plan</label>
                                    <select name="seatplan" id="seatplan" class="form-control selectpicker" data-live-search="true" required>
                                        <option value="">Select Seat Plan</option>
                                        @foreach (\App\BusSeatPlan::all() as $item)
                                            <option value="{{ $item->id }}">{{ $item->type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
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
@endsection