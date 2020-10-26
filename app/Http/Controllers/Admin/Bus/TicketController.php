<?php

namespace App\Http\Controllers\Admin\Bus;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\BusTicket;

class TicketController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $tickets = BusTicket::with('ticket_seat', 'boarding', 'schedule.organization')->orderBy('id', 'DESC')->get();
        return view('admin.bus.ticket.index', compact('tickets'));
    }

    public function details(Request $request)
    {
        $ticket = BusTicket::with('ticket_seat', 'schedule.route.from_city', 'schedule.route.to_city', 'boarding.counter', 'cancel', 'transection')->where('id', $request->id)->first();
        return $ticket;
    }
}
