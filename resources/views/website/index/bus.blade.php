<script>
    // Bus Search Area Start
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(".bus_filter").click(function(){
    $(".bus_filter").removeClass('btn-success');
    $(".bus_filter").addClass('btn-info');
    $(this).removeClass('btn-info');
    $(this).addClass('btn-success');

    if($(this).data('filter') == 0){
        $(".bus_result_tr").removeClass('show');
        $(".bus_result_tr").addClass('show');
    }else{
        $(".bus_result_tr").removeClass('show');
        $("tr[data-bus-class='"+$(this).data('filter')+"']").addClass('show');
    }
})

$("#bus_search_form").submit(function(e){
    e.preventDefault();
    var form_data = $(this).serialize();
    
    var date = $("#date").val();
    $("#bus_selected_date").val(date);
    
    
    if(date == "")
    {
        alert("Please Select Travel Date");
    }else{
        $(".loading").addClass('show');
        var uri = '{{ route("search.bus.get") }}';
        $.ajax({
            url: uri,
            method: 'POST',
            data: form_data,
            success: function(data){
                console.log(data);
                $(".loading").removeClass("show");
                if(data == '')
                {
                    $("#bus_search_tbl tbody").find("*").remove();
                    console.log('No Data Found!')
                }else{
                    // console.log(data); 
                    $("#bus_search_tbl tbody").find("*").remove();

                    $.each(data, function(id, item){
                        // console.log(item);
                        var seat_booked = 0;
                        $.each(item.tickets, function(index, ticket){
                            // console.log(ticket.ticket_seat.length)
                            seat_booked += ticket.ticket_seat.length
                        })
                        console.log(item);
                        var op_name = item.organization.name;
                        var from_city = item.route.from_city.name;
                        var to_city = item.route.to_city.name;
                        $("#bus_search_tbl tbody").append('<tr class="bus_result_tr show" data-bus-class="'+item.bus.class+'"><td data-label="Operator"><ul class="bus_info"><li class="op_name">'+op_name+'</li><li class="bus_type">'+item.bus.clases.name+' - '+item.bus.model+'</li><li class="bus_type"><strong>Route: </strong>'+from_city+'-'+to_city+'</li></ul><ul class="ratings"><li><span class="fa fa-star"></span></li><li><span class="fa fa-star"></span></li><li><span class="fa fa-star"></span></li><li><span class="fa fa-star-half-o"></span></li><li><span class="fa fa-star-o"></span></li></ul></td><td data-label="Dep. Time">'+item.dep_time+'</td><td data-label="Arr. Time">'+item.arr_time+'</td><td data-label="Seats Available">'+(item.total_seat-seat_booked)+'</td><td data-label="Fare Charge"><div class="charge">৳ '+item.charge+'</div><div class="view-btn"> <button class="btn btn-success show_seats" data-toggle="modal" data-target=".viewSeatModal" data-id="'+item.id+'" onclick="get_result('+item.id+')">View Seats</button></div></td></tr>');
                    })
                }
            }
        });
        
        $("#result_bus").addClass('result_area_show')
        $('html, body').animate({
            scrollTop: $("#result_section").offset().top
        }, 1000)

        
    }

    
})

function get_result(id){
    selected_seat();
    $(".book_btn").prop('disabled', false);
    $(".book_btn").removeClass('btn-dark');
    $(".seat_btn").removeClass('btn-light');
    $(".seat_btn").removeClass('btn-success');
    $(".book_btn").addClass('seat_btn');
    $(".seat_btn").removeClass('book_btn');
    $(".seat_btn").addClass('btn-light');

    $(".loading").addClass('show')
    $(".bus-ticket-process").removeClass('show')
    $("#bus-step-one").addClass('show')
    var date = $("#date").val();
    $("select[data-item='select-boarding']").find("*").remove();
    $.ajax({
        url: "{{ route('search.bus.detail') }}",
        method: 'POST',
        data: {
            schedule: id,
            date: date
        },
        success: function(data){
            $(".loading").removeClass('show')
            console.log(data);
            $("#bus_schedule_no").val(data.id);
            $("input[data-item='charge']").val(data.charge);
            var charge = $("input[data-item='charge']").val();
            $("#show-charge").text(charge);
            $("#seat_charge").val(charge);
            $("h1[data-city='from']").text(data.route.from_city.name)
            $("h1[data-city='to']").text(data.route.to_city.name)
            $("span[data-item='date']").text($("#date").val());
            $("span[data-item='time']").text(data.dep_time);

            $.each(data.boarding, function(i, item){
                // console.log(item);
                $("select[data-item='select-boarding']").append('<option value="'+item.id+'" data-boarding-time="'+item.arr_time+'">'+item.counter.name+'</option>')
            })

            $.each(data.tickets, function(index, ticket){
                $.each(ticket.ticket_seat, function(index, item){
                    $("button[data-ticket-id="+item.seat_id+"]").removeClass('seat_btn');
                    $("button[data-ticket-id="+item.seat_id+"]").removeClass('btn-light');
                    $("button[data-ticket-id="+item.seat_id+"]").addClass('btn-dark');
                    $("button[data-ticket-id="+item.seat_id+"]").addClass('book_btn');
                    $("button[data-ticket-id="+item.seat_id+"]").prop('disabled', 'true');
                })
            });

            var bp = $("select[data-item='select-boarding']").find(":selected").text();
            var bi = $("select[data-item='select-boarding']").find(":selected").val();
            var bt = $("select[data-item='select-boarding']").find(":selected").data("boarding-time");
            $("span[data-item='boarding-point']").text(bp);
            $("span[data-item='boarding-time']").text(bt);
            $("#boarding_point_id").val(bi);
        }
    });
}

$("#boarding_point").change(function(){
    var bp = $(this).find(":selected").text();
    var bi = $(this).find(":selected").val();
    var bt = $(this).find(":selected").data("boarding-time");
    $("span[data-item='boarding-point']").text(bp);
    $("span[data-item='boarding-time']").text(bt);
    $("#boarding_point_id").val(bi);
})




$(".seat_btn").click(function(){
    if($(this).hasClass('btn-light')){
        $(this).removeClass('btn-light')
        $(this).addClass('btn-success')
    }else{
        $(this).removeClass('btn-success')
        $(this).addClass('btn-light')
    }

    selected_seat();
})

function selected_seat(){
    var seats = [];

    

    $("#seat_list").find("*").remove();
    $(".btn-success.seat_btn").each(function(){
        seats.push($(this).text())
        $("#seat_list").append('<input type="hidden" name="seat_no[]" value="'+$(this).text()+'">');
    })

    var charge = $("input[data-item='charge']").val();

    console.log(seats.length)
    if(seats.length > 0)
    {
        $("#btn-go-two").prop('disabled', false)
    }else{
        $("#btn-go-two").prop('disabled', true)
    }

    $(".total-amount").text((seats.length*charge)+20);
    $("#total_seat").val(seats.length);
    $("#total_charge").val((seats.length*charge)+20);

    $(".seat_items").text(seats)
    $(".total-seat span").text(seats.length+" x 1 = "+seats.length)
}

$(".bus_btn").click(function(){
    $(".bus-ticket-process").removeClass('show');
    var step = $(this).attr("id");
    step = step.replace("btn-go-", '');
    $("#bus-step-"+step).addClass("show");
})

$(".show_seats").click(function(){
    
})

$(".method-item label").click(function(){
    $(".method-item label img").removeClass('clicked');
    $(this).find("img").addClass('clicked')
})

$("#ticket_booking_form").submit(function(e){
    e.preventDefault();
    var form_data = $(this).serialize();
    console.log(form_data)
    $(".loading").addClass('show');
    $.ajax({
        url: "{{ route('search.bus.buy') }}",
        method: 'POST',
        data: form_data,
        success: function(data){
            $(".loading").removeClass('show')
            console.log(data);
            if(data.status == 200)
            {
                $(".bus-ticket-process").removeClass('show');
                $("#bus-step-three").addClass('show');
                $("#ticket-no").text(data.data.ticket_no);
            }
        }
    })
})

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

<script>
    // Create a new Particle
var ps = new ParticleSlider({
  ptlGap: 1,
  mouseForce: 100 ,
  monochrome: true ,
  color: '#ffffff' ,
  ptlSize: 1,
  
});

var ptl = new ps.Particle(ps);

// Set time to live of Particle to20 frames.
ptl.ttl = 100;
</script>

<script>

</script>