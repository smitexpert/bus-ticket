<script>

    $(document).ready(function(){
        var id = $("#schedule").val();
        var date = $("#date").val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
        url: "{{ route('counter.ticket.details') }}",
        method: 'POST',
        data: {
            id: id,
            date: date
        },
        success: function(data)
        {
            $.each(data.tickets, function(i, d){
                $.each(d.ticket_seat, function(id, item){
                    $("button[data-ticket-id="+item.seat_id+"]").removeClass('btn-light');
                    $("button[data-ticket-id="+item.seat_id+"]").removeClass('btn-success');
                    $("button[data-ticket-id="+item.seat_id+"]").removeClass('seat_btn');
                    $("button[data-ticket-id="+item.seat_id+"]").addClass('btn-dark');
                    $("button[data-ticket-id="+item.seat_id+"]").prop('disabled', true);
                })
            })
            $(".loading").removeClass("show");
            
        }
    });
    })

    

    $(".seat_btn").click(function(){
        
        if($(this).hasClass('btn-light')){
            $(this).removeClass('btn-light');
            $(this).addClass('btn-success');
        }else{
            $(this).removeClass('btn-success');
            $(this).addClass('btn-light');
        }

        add_seat();
    });

    function add_seat(){
        var seats = [];

        $("#add_seat").find("*").remove();
        $(".btn-success.seat_btn").each(function(){
            seats.push($(this).text());
            $("#add_seat").append('<input type="hidden" name="seat[]" value="'+$(this).text()+'">');
        })

        var seat_charge = $("#seat_charge").val();
        $("#total_charge").val(seat_charge*seats.length);

        $("#selected_seat_show").val(seats);
        

        if(seats.length == 0){
            $(".submit_btn").prop('disabled', true);
        }else{
            $(".submit_btn").prop('disabled', false);
        }
    }
</script>