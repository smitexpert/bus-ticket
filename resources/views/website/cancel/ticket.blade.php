@extends('website.layouts.site')
@section('content')
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Ticket Cancellation</h4>
                </div>
                <div class="card-body">
                    <div class="text-center">
                        <h1><span class="fa fa-check"></span></h1>
                    </div>
                    <h3>Your Ticket <strong><code>{{ $ticket->ticket_no }}</code></strong> Has Been Cancelled.</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4"></div>
    </div>
    <br>
@endsection

@push('scripts')
<script>
    $("#show_cancel_area").click(function(){
    $("#cancel_one").addClass('show');
})

$("#cn_op_one").click(function(){
    $(".cancel_ticket_area").removeClass('show');
    $("#cancel_one").addClass('show');
})

$("#search_ticket_for_cancel").submit(function(e){
    e.preventDefault();
    var form_data = $(this).serialize();
    // $("#cn_bus_seat").find('span').reomve();
    
    $.ajax({
        url: "{{ route('search.cancel.ticket') }}",
        method: 'post',
        data: form_data,
        success: function(data){
            console.log(data);
            if(data.status == 200)
            {
                $(".cancel_ticket_area").removeClass('show');
                $("#cancel_two").addClass('show');
                $("#cn_ticket_id").val(data.data.id)
                $("#cn_passenger_name").text(data.data.customer_name)
                $("#cn_bus_operator").text(data.data.schedule.organization.name)
                $("#cn_bus_route").text(data.data.schedule.route.from_city.name+"-"+data.data.schedule.route.to_city.name);
                $("#cn_bus_schedule").text(data.data.date+" at "+data.data.schedule.dep_time)
                $("#cn_ticket_status").text(data.data.status)
                $.each(data.data.ticket_seat, function(i, item){
                    $("#cn_bus_seat").append('<span>'+item.seat_id+', </span>');
                })
                if(data.data.status == 'cancelled'){
                    $("#cn_reason").css('display', 'none');
                    $("#cn_btn").css('display', 'none');
                }else{
                    $("#cn_reason").css('display', 'block');
                    $("#cn_btn").css('display', 'block');
                }
                // console.log(data.data.id);
            }
        }
    })
})
</script>
@endpush