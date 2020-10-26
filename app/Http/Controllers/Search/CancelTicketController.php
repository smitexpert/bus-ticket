<?php

namespace App\Http\Controllers\Search;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\BusTicket;

class CancelTicketController extends Controller
{
    public function __construct()
    {
        
    }

    public function get(Request $request)
    {
        $ticket = BusTicket::with('schedule.organization', 'schedule.route.from_city', 'schedule.route.to_city', 'ticket_seat')->where('ticket_no', $request->ticket_no)->first();
        if($ticket)
        {
            $response['status'] = 200;
            $response['data'] = $ticket;
        }else{
            $response['status'] = 205;
            $response['message'] = "Ticket Not Found";
        }
        return $response;
    }
}
