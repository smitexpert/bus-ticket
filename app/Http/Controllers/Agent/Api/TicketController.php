<?php

namespace App\Http\Controllers\Agent\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\BusTicket;
use App\BusTransection;
use App\BusSchedule;
use App\BusCounter;
use App\BusTicketSeat;
use Illuminate\Support\Str;

class TicketController extends Controller
{
    public function tickets()
    {
        $tickets = BusTicket::whereHas('schedule', function($query){
            $query->where('bus_organization_id', auth('api')->user()->bus_organizations_id);
        })->with('ticket_seat', 'boarding', 'schedule.organization')->orderBy('id', 'DESC')->get();

        return response([
            'status' => 200,
            'success' => true,
            'data' => $tickets
        ], 200);
    }

    public function details($id)
    {
        $ticket = BusTicket::with('ticket_seat', 'schedule.route.from_city', 'schedule.route.to_city', 'boarding.counter', 'cancel', 'transection')->where('id', $id)->first();
        
        if(empty($ticket))
        {
            return response([
                'status' => 404,
                'success' => false,
                'message' => 'Ticket Not Found'
            ], 404);
        }

        return response([
            'status' => 200,
            'success' => true,
            'data' => $ticket
        ], 200);
    }

    public function search($no)
    {
        $ticket = BusTicket::whereHas('schedule', function($query){
            $query->where('bus_organization_id', auth('api')->user()->bus_organizations_id);
        })->with('ticket_seat', 'schedule.route.from_city', 'schedule.route.to_city', 'boarding.counter', 'cancel', 'transection')->where('ticket_no', $no)->where('status', '!=', 'cancelled')->first();

        if(empty($ticket))
        {
            return response([
                'status' => 404,
                'success' => false,
                'message' => 'Ticket Not Found!'
            ], 404);
        }

        return response([
            'status' => 200,
            'success' => true,
            'data' => $ticket
        ], 200);
    }

    public function cancel($no)
    {
        $query = BusTicket::whereHas('schedule', function($query){
                    $query->where('bus_organization_id', auth('api')->user()->bus_organizations_id);
                })->where('ticket_no', $no)->where('status', '!=', 'cancelled')->update([
                    'status' => 'cancelled'
                ]);

        if(!$query)
        {
            return response([
                'status' => 400,
                'success' => false,
                'messsage' => 'Bad Requrest'
            ], 400);
        }

        $id = BusTicket::whereHas('schedule', function($query){
            $query->where('bus_organization_id', auth('api')->user()->bus_organizations_id);
        })->where('ticket_no', $no)->where('status', '!=', 'cancelled')->first();

        BusTransection::where('bus_ticket_id', $id)->update([
            'status' => 'cancelled'
        ]);

        return response([
            'status' => 200,
            'success' => true,
            'message' => 'Ticket Cancelled!'
        ], 200);

    }

    public function schedules(Request $request)
    {
        $date = $request->date;

        $schedules = BusSchedule::where('bus_route_id', $request->route)->with(['tickets' => function($query) use ($date){
            return $query->where('date', $date)->withCount('ticket_seat');
        }])->with('bus.clases', 'route.from_city', 'route.to_city')->orderBy('dep_time', 'ASC')->get();
        
        if(empty($schedules))
        {
            return response([
                'status' => 404,
                'success' => false,
                'message' => 'Schedule Not Found!'
            ], 404);
        }

        $data['schedules'] = $schedules;
        $data['date'] = $date;

        return response([
            'status' => 200,
            'success' => true,
            'data' => $data
        ], 200);
    }

    public function agentCounter($id)
    {
        $counter = BusCounter::whereHas('boarding', function($query) use ($id){
            $query->where('bus_schedule_id', $id);
        })->where('agent_id', auth('api')->user()->id)->get();

        return response([
            'status' => 200,
            'success' => true,
            'data' => $counter
        ], 200);
    }

    public function scheduleDetails($id, $date)
    {
        $counter = BusCounter::whereHas('boarding', function($query) use ($id){
            $query->where('bus_schedule_id', $id);
        })->where('agent_id', auth('api')->user()->id)->get();
        $result = BusSchedule::with('route.from_city', 'route.to_city', 'bus.clases')->where('id', $id)->where('bus_organization_id', auth('api')->user()->bus_organizations_id)->firstOrFail();

        $seats = BusSchedule::with(['tickets' => function($query) use ($date){
            return $query->where('date', $date)->with('ticket_seat');
        }])->where('id', $id)->where('bus_organization_id', auth('api')->user()->bus_organizations_id)->firstOrFail();

        if(empty($result))
        {
            return response([
                'status' => 400,
                'success' => false,
                'message' => 'Bad Request'
            ], 400);
        }

        $data['result'] = $result;
        $data['seats'] = $seats;
        $data['counter'] = $counter;
        $data['date'] = $date;

        return response([
            'status' => 200,
            'success' => true,
            'data' => $data
        ], 200);
    }

    public function sell(Request $request)
    {
        $request->validate([
            'bus_schedule_id' => 'required',
            'bus_boarding_id' => 'required',
            'customer_name' => 'required',
            'customer_phone' => 'required',
            'gender' => 'required',
            'seat_charge' => 'required',
            'date' => 'required',
            'seat_id' => 'required'
        ]);

        $ticket = BusTicket::create([
            'ticket_no' => mt_rand(100000, 999999),
            'bus_schedule_id' => $request->bus_schedule_id,
            'bus_boarding_id' => $request->bus_boarding_id,
            'customer_name' => $request->customer_name,
            'customer_phone' => $request->customer_phone,
            'customer_email' => $request->customer_email,
            'gender' => $request->gender,
            'total_seat' => count($request->seat_id),
            'seat_charge' => $request->seat_charge,
            'date' => $request->date,
            'status' => 'booked'
        ]);

        for($i=0; $i<count($request->seat_id); $i++){
            $seat_no[] = [
                'bus_ticket_id' => $ticket->id,
                'seat_id' => $request->seat_id[$i],
                'created_at' => now()
            ];
        }

        $ticketSeat = BusTicketSeat::insert($seat_no);

        $transection = BusTransection::create([
            'trxID' => Str::random(12),
            'bus_ticket_id' => $ticket->id,
            'discount' => 0,
            'service_charge' => 0,
            'total' => count($request->seat_id)*$request->seat_charge,
            'payment_method' => 'cash'
        ]);

        $seats = $request->seat_id;

        $data['ticket'] = $ticket;
        $data['seats'] = $seats;
        $data['transection'] = $transection;

        return response([
            'status' => 200,
            'success' => true,
            'data' => $data
        ], 200);


    }


}

