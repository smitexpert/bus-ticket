<?php

namespace App\Http\Controllers\Search;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\BusSchedule;
use App\BusRoute;
use App\District;
use App\BusTicket;
use App\BusTicketSeat;
use Illuminate\Support\Str;
use App\BusTransection;

class BusController extends Controller
{
    public function __construct()
    {
        
    }

    public function get(Request $request)
    {
        $date = $request->date;
        if($request->date == date('Y-m-d'))
        {
            $now = date('H:i').'00';
            
            $from = District::where('name', $request->bus_form)->first();
            $to = District::where('name', $request->bus_to)->first();

            // $route = BusRoute::with(['schedules' => function($query){
            //     return $query->where('dep_time', '>=', date("H:i:s"));
            // }])->with(['schedules.tickets' => function($query) use ($date){
            //     return $query->where('date', $date)->with('ticket_seat');
            // }])->with('schedules', 'schedules.organization', 'schedules.bus.clases', 'from_city', 'to_city')->where('from', $from->id)->where('to', $to->id)->get();

            // $route = BusRoute::where('from', $from->id)->where('to', $to->id)->get();
            // $schedules = BusSchedule::

            $schedules = BusSchedule::whereHas('route', function($query) use ($from, $to){
                $query->where('from', $from->id)->where('to', $to->id);
            })->with(['tickets' => function($query) use ($date){
                return $query->where('date', $date)->with('ticket_seat');
            }])->with('organization', 'bus.clases', 'route.from_city', 'route.to_city')->where('dep_time', '>=', date("H:i:s"))->get();;

            return $schedules;
        }
        else{
            $from = District::where('name', $request->bus_form)->first();
            $to = District::where('name', $request->bus_to)->first();

            // $route = BusRoute::with(['schedules.tickets' => function($query) use ($date){
            //     return $query->where('date', $date)->with('ticket_seat');
            // }])->with('schedules', 'schedules.organization', 'schedules.bus.clases', 'from_city', 'to_city')->where('from', $from->id)->where('to', $to->id)->get();

            // $schedules = BusSchedule::with(['route' => function($query) use ($from, $to){
            //     return $query->where('from', $from->id)->where('to', $to->id);
            // }])->with(['tickets' => function($query) use ($date){
            //     return $query->where('date', $date)->with('ticket_seat');
            // }])->with('organization', 'bus.clases', 'route.from_city', 'route.to_city')->orderBy('dep_time', 'ASC')->get();;

            $schedules = BusSchedule::whereHas('route', function($query) use ($from, $to){
                $query->where('from', $from->id)->where('to', $to->id);
            })->with(['tickets' => function($query) use ($date){
                return $query->where('date', $date)->with('ticket_seat');
            }])->with('organization', 'bus.clases', 'route.from_city', 'route.to_city')->orderBy('dep_time', 'ASC')->get();
            
            // $route = BusRoute::where('from', $from->id)->where('to', $to->id)->get();
            // $schedules = BusSchedule::

            return $schedules;

        }
    }

    public function detail(Request $request)
    {
        $date = $request->date;
        $schedule = BusSchedule::with(['tickets' => function($query) use ($date){
            return $query->where('date', $date)->with('ticket_seat');
        }])->with('route.from_city', 'route.to_city', 'boarding.counter', 'bus.seatplan')->where('id', $request->schedule)->first();
        return $schedule;
    }

    public function buy(Request $request)
    {
        $request->validate([
            'bus_schedule_no' => 'required',
            'seat_no' => 'required',
            'total_seat' => 'required',
            'total_charge' => 'required',
            'boarding_point_id' => 'required',
            'discount' => 'required',
            'customer_name' => 'required',
            'gender' => 'required',
            'seat_charge' => 'required',
            'customer_phone' => 'required',
            'payment_method' => 'required',
            'bus_selected_date'=> 'required'
        ]);

        $id = BusTicket::insertGetId([
            'ticket_no' => mt_rand(100000, 999999),
            'bus_schedule_id' => $request->bus_schedule_no,
            'bus_boarding_id' => $request->boarding_point_id,
            'customer_name' => $request->customer_name,
            'customer_phone' => $request->customer_phone,
            'customer_email' => $request->customer_email,
            'gender' => $request->gender,
            'total_seat' => $request->total_seat,
            'seat_charge' => $request->seat_charge,
            'date' => $request->bus_selected_date,
            'created_at' => now()
        ]);


        for($i=0; $i<count($request->seat_no); $i++)
        {
            $ticket_seats[] = [
                'bus_ticket_id' => $id,
                'seat_id' => $request->seat_no[$i],
                'created_at' => now()
            ];
        }

        BusTicketSeat::insert($ticket_seats);

        BusTransection::create([
            'trxID' => Str::random(12),
            'bus_ticket_id' => $id,
            'discount' => $request->discount,
            'service_charge' => $request->service_charge,
            'total' => $request->total_charge,
            'payment_method' => $request->payment_method
        ]);

        $response['status'] = 200;
        $response['data'] = BusTicket::where('id', $id)->first();

        return response($response, 200);

        // return $request->all();
    }
}
