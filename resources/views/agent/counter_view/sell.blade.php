@extends('agent.layout.counter')
@push('styles')
    <link href="{{ asset("backend") }}/assets/plugins/datatables/css/jquery.datatables.min.css" rel="stylesheet">
    <link href="{{ asset("backend") }}/assets/plugins/datatables/css/jquery.datatables_themeroller.css" rel="stylesheet">
    <link href="{{ asset("backend") }}/assets/plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('website') }}/assets/css/flatpickr.min.css">
@endpush
@push('scripts')
    <script src="{{ asset("backend") }}/assets/plugins/datatables/js/jquery.datatables.min.js"></script>
    <script src="{{ asset("backend") }}/assets/plugins/bootstrap-select/js/bootstrap-select.min.js"></script>
    <script src="{{ asset("website") }}/assets/js/flatpickr.js"></script>
    <script>
        $("#date").flatpickr({
            altInput: true,
            altFormat: "F j, Y",
            dateFormat: "Y-m-d",
            minDate: "today",
            defaultDate: "today"
        })
    </script>
@endpush
@section('content')
    <div class="container">
        <form action="{{ route('counter.sell.ticket.search') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="route">Select Route</label>
                        <select name="route" id="route" class="form-control form-control-sm selectpicker" data-live-search="true" required>
                            <option value="">Select</option>
                            @foreach ($routes as $item)
                                <option value="{{ $item->id }}">{{ $item->from_city->name }}-{{ $item->to_city->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="date">Select Date</label>
                        <input type="text" name="date" id="date" class="form-control form-control-sm" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div style="margin-top:32px"></div>
                    <button class="btn btn-sm btn-success">Submit</button>
                </div>
            </div>
        </form>
    </div>
@endsection