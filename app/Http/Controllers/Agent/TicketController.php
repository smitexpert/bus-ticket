<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\BusTicket;
use PDF;
use App\BusCounter;

class TicketController extends Controller
{
    public function __construct()
    {
        $this->middleware('agent.auth:agent');
    }

    public function index()
    {
        $tickets = BusTicket::whereHas('schedule', function($query){
            $query->where('bus_organization_id', auth('agent')->user()->bus_organizations_id);
        })->with('ticket_seat', 'boarding', 'schedule.organization')->orderBy('id', 'DESC')->get();

        // $tickets = BusTicket::with(['schedule' => function($query){
        //     return $query->where('bus_organization_id', auth('agent')->user()->bus_organizations_id);
        // }])->with('ticket_seat', 'boarding', 'schedule.organization')->get();

        return view('agent.ticket.index', compact('tickets'));
        // return dd($tickets);
    }

    public function details(Request $request)
    {
        $ticket = BusTicket::with('ticket_seat', 'schedule.route.from_city', 'schedule.route.to_city', 'boarding.counter', 'cancel', 'transection')->where('id', $request->id)->first();
        return $ticket;
    }

    public function search()
    {
        return view('agent.ticket.search');
    }

    public function searchResult(Request $request)
    {
        $ticket = BusTicket::whereHas('schedule', function($query){
            $query->where('bus_organization_id', auth('agent')->user()->bus_organizations_id);
        })->where('ticket_no', $request->ticket_id)->where('status', '!=', 'cancelled')->first();
        
        
        if($ticket){
            $response['status'] = 200;
            $response['data'] = $ticket;
        }else{
            $response['status'] = 205;
            $response['message'] = 'Ticket Not Found';
        }

        return $response;
    }

    public function print($ticket)
    {
        $result = BusTicket::with('ticket_seat', 'schedule.route.from_city', 'schedule.route.to_city', 'boarding.counter', 'cancel', 'transection')->where('ticket_no', $ticket)->first();
        // $pdf = PDF::loadView('agent.ticket.print');
        // return $pdf->stream();
        
        $data = [
                'result' => $result
            ];
            
        return view('agent.ticket.print', compact('result'));
        // return dd($data);
        // $pdf = PDF::loadView('agent.ticket.print', $data);
        // return $pdf->stream();
    }
}
