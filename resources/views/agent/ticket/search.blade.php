@extends('agent.layout.main')
@push('styles')
    <link href="{{ asset("backend") }}/assets/plugins/datatables/css/jquery.datatables.min.css" rel="stylesheet">
    <link href="{{ asset("backend") }}/assets/plugins/datatables/css/jquery.datatables_themeroller.css" rel="stylesheet">
    <link href="{{ asset("backend") }}/assets/plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet">
@endpush

@section('content')
@include('agent.partial.alert')
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="panel panel-white">
                <div class="panel-header">
                    <h4 class="panel-title">Search Ticket</h4>
                </div>
                <div class="panel-body">
                    <form action="" id="search_ticket_form">
                        @csrf
                        <div class="input-group">
                            <input type="text" name="ticket_id" class="form-control" placeholder="Ticket ID">
                            <span class="input-group-btn">
                              <button type="submit" class="btn btn-default" type="button">Search</button>
                            </span>
                          </div><!-- /input-group -->
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div id="result_option">
                <table class="table" id="result_table">
                    <thead>
                        <tr>
                            <th>Ticket Number</th>
                            <th>Passenger Name</th>
                            <th>Passenger Mobile Number</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset("backend") }}/assets/plugins/datatables/js/jquery.datatables.min.js"></script>
    <script src="{{ asset("backend") }}/assets/plugins/bootstrap-select/js/bootstrap-select.min.js"></script>
    <script>
        $("#search_ticket_form").submit(function(e){
            e.preventDefault();
            var form_data = $(this).serialize();

            $("#result_table tbody").find("*").remove();
            
            $.ajax({
                url: "{{ route('agent.ticket.search.result') }}",
                method: "POST",
                data: form_data,
                success: function(data){
                    console.log(data)
                    if(data.status == 200){
                        $("#result_table tbody").append('<tr><td id="ticket_number">'+data.data.ticket_no+'</td><td id="passenger_name">'+data.data.customer_name+'</td><td id="passenger_mobile">'+data.data.customer_phone+'</td><td><a href="{{ url("/") }}/agent/ticket/'+data.data.ticket_no+'/print" target="_blank" class="btn btn-sm btn-info"><span class="fa fa-print"></span></a></td></tr>');
                    }else{
                        $("#result_table tbody").append('<tr><td colspan="5"><div class="text-center">'+data.message+'</div></td></tr>');
                    }
                }
            })
        })
    </script>
@endpush