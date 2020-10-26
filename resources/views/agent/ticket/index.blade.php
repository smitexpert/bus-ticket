@extends('agent.layout.main')
@push('styles')
    <link href="{{ asset("backend") }}/assets/plugins/datatables/css/jquery.datatables.min.css" rel="stylesheet">
    <link href="{{ asset("backend") }}/assets/plugins/datatables/css/jquery.datatables_themeroller.css" rel="stylesheet">
    <link href="{{ asset("backend") }}/assets/plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet">
@endpush

@section('content')
@include('agent.partial.alert')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-white">
                <div class="panel-header">
                    <h4 class="panel-title">Purchase History List</h4>
                </div>
                <div class="panel-body">
                    <table class="table table-responsive" id="table">
                        <thead>
                            <tr>
                                <th>Ticket No.</th>
                                {{-- <th>Op Name</th> --}}
                                <th>Customer Name</th>
                                <th>Customer Phone</th>
                                <th>Customer Email</th>
                                <th>Seat(s)</th>
                                <th>Charge</th>
                                <th>Dep. Time</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                           @foreach ($tickets as $item)
                               <tr>
                                   <td>{{ $item->ticket_no }}</td>
                                   {{-- <td>{{ $item->schedule->organization->name }}</td> --}}
                                   <td>{{ $item->customer_name }}</td>
                                   <td>{{ $item->customer_phone }}</td>
                                   <td>{{ $item->customer_email }}</td>
                                   <td>
                                       @foreach ($item->ticket_seat as $seat)
                                           {{ $seat->seat_id }},
                                       @endforeach
                                   </td>
                                   <td>{{ $item->seat_charge }}</td>
                                   <td>{{ $item->boarding->arr_time }}</td>
                                   <td>{{ $item->status }}</td>
                                   <td>
                                       <div class="btn-group">
                                           <button class="btn btn-sm btn-primary showDetails"  data-id="{{ $item->id }}" data-toggle="modal" data-target="#modalView"><span class="fa fa-search"></span></button>
                                       </div>
                                   </td>
                               </tr>
                           @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Ticket No.</th>
                                {{-- <th>Op Name</th> --}}
                                <th>Customer Name</th>
                                <th>Customer Phone</th>
                                <th>Customer Email</th>
                                <th>Seat(s)</th>
                                <th>Charge</th>
                                <th>Dep. Time</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

<div class="modal fade" id="modalView" tabindex="-1" role="dialog" aria-labelledby="modalViewLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="modalViewLabel">Ticket Details</h4>
        </div>
        <div class="modal-body">
            <table class="table table-responsive">
                <tr>
                    <td>Passenger Name</td>
                    <td>:</td>
                    <td id="passenger_name"></td>
                </tr>
                <tr>
                    <td>Passenger Mobile No.</td>
                    <td>:</td>
                    <td id="passenger_mobile"></td>
                </tr>
                <tr>
                    <td>Passenger Gender</td>
                    <td>:</td>
                    <td id="passenger_gender"></td>
                </tr>
                <tr>
                    <td>Route</td>
                    <td>:</td>
                    <td id="route"></td>
                </tr>
                <tr>
                    <td>Schedule</td>
                    <td>:</td>
                    <td id="schedule"></td>
                </tr>
                <tr>
                    <td>Bording</td>
                    <td>:</td>
                    <td id="boarding"></td>
                </tr>
                <tr>
                    <td>Seat(s)</td>
                    <td>:</td>
                    <td id="seats"></td>
                </tr>
                <tr>
                    <td>Total Charged</td>
                    <td>:</td>
                    <td id="total_charged"></td>
                </tr>
                <tr>
                    <td>TrxID</td>
                    <td>:</td>
                    <td id="trxid"></td>
                </tr>
                <tr>
                    <td>Payment Method</td>
                    <td>:</td>
                    <td id="payment_method"></td>
                </tr>
                <tr>
                    <td>Payment Status</td>
                    <td>:</td>
                    <td id="payment_status"></td>
                </tr>
                <tr>
                    <td>Ticket Status</td>
                    <td>:</td>
                    <td id="ticket_status"></td>
                </tr>
            </table>
        </div>
        <div class="modal-footer">
        </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
    <script src="{{ asset("backend") }}/assets/plugins/datatables/js/jquery.datatables.min.js"></script>
    <script src="{{ asset("backend") }}/assets/plugins/bootstrap-select/js/bootstrap-select.min.js"></script>
    <script>
        $("#table").dataTable();

        $("#table").on('click', '.showDetails', function(){
            $("#passenger_name").text('');
            $("#passenger_mobile").text('');
            $("#passenger_gender").text('');
            $("#route").text('');
            $("#schedule").text('');
            $("#boarding").text('');
            $("#seats").text('');
            $("#total_charged").text('');
            $("#trxid").text('');
            $("#payment_method").text('');
            $("#payment_status").text('');

            var id = $(this).data('id');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{ route('agent.ticket.details') }}",
                method: "POST",
                data: {
                    id: id
                },
                success: function(data){
                    console.log(data);
                    $("#passenger_name").text(data.customer_name);
                    $("#passenger_mobile").text(data.customer_phone);
                    $("#passenger_gender").text(data.gender);
                    $("#route").text(data.schedule.route.from_city.name+'-'+data.schedule.route.to_city.name);
                    $("#schedule").text(data.date+" at "+data.schedule.dep_time);
                    $("#boarding").text(data.boarding.counter.name+" at "+data.boarding.arr_time);
                    $.each(data.ticket_seat, function(i, item){
                        $("#seats").append('<span>'+item.seat_id+', </span>');
                    })
                    $("#total_charged").text(data.transection.total);
                    $("#trxid").text(data.transection.trxID);
                    $("#payment_method").text(data.transection.payment_method);
                    $("#payment_status").text(data.transection.status);
                    $("#ticket_status").text(data.status);
                }
            })
        })
    </script>
@endpush