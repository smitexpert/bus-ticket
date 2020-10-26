<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BusTicket;
use App\BusTicketCancel;
use App\BusTicketSeat;
use App\BusTransection;

class WebsiteController extends Controller
{
    public function __construct()
    {
        
    }

    public function index()
    {
        return view('website.cancel.ticket');
    }

    public function ticketCancel(Request $request)
    {
        $ticket_id = $request->cn_ticket_id;
        BusTicket::where('id', $ticket_id)->update([
            'status' => 'cancelled',
            'total_seat' => 0
        ]);

        BusTicketSeat::where('bus_ticket_id', $ticket_id)->delete();

        BusTicketCancel::create([
            'ticket_id' => $ticket_id,
            'reason' => $request->reason
        ]);

        $tr = BusTransection::where('bus_ticket_id', $ticket_id)->first();

        if($tr->status == 'paid')
        {
            BusTransection::where('id', $tr->id)->update([
                'status' => 'refunded'
            ]);
        }else{
            BusTransection::where('id', $tr->id)->update([
                'status' => 'cancelled'
            ]);
        }

        $ticket = BusTicket::where('id', $ticket_id)->first();

        return view('website.cancel.ticket', compact('ticket'));
    }
}
