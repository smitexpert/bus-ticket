<?php

namespace App\Http\Controllers\Agent\Counter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\BusRoute;
use App\BusSchedule;
use App\BusCounter;
use App\BusTicket;
use App\BusTicketSeat;
use App\BusTransection;
use Illuminate\Support\Str;

class SellTicketController extends Controller
{
    public function __construct()
    {
        $this->middleware('agent.auth:agent');
        $this->middleware('agent_role:super;counter');
    }

    public function index()
    {
        $routes = BusRoute::with('from_city', 'to_city')->where('bus_organization_id', auth('agent')->user()->bus_organizations_id)->get();
        return view('agent.counter_view.sell', compact('routes'));
    }

    public function search(Request $request)
    {
        $date = $request->date;
        $routes = BusRoute::with('from_city', 'to_city')->where('bus_organization_id', auth('agent')->user()->bus_organizations_id)->get();
        $schedules = BusSchedule::where('bus_route_id', $request->route)->with(['tickets' => function($query) use ($date){
            return $query->where('date', $date)->withCount('ticket_seat');
        }])->with('bus.clases')->orderBy('dep_time', 'ASC')->get();
        return view('agent.counter_view.result', compact('schedules', 'routes', 'date'));
        // return dd($schedules);
    }

    public function sell($id, $date)
    {
        $counter = BusCounter::whereHas('boarding', function($query) use ($id){
            $query->where('bus_schedule_id', $id);
        })->where('agent_id', auth('agent')->user()->id)->get();
        $result = BusSchedule::with('route.from_city', 'route.to_city', 'bus.clases')->where('id', $id)->where('bus_organization_id', auth('agent')->user()->bus_organizations_id)->firstOrFail();
        // return $result;
        return view('agent.counter_view.sellticket', compact('result', 'date', 'counter'));
    }

    public function ticket_details(Request $request)
    {
        $date = $request->date;

        $result = BusSchedule::with(['tickets' => function($query) use ($date){
            return $query->where('date', $date)->with('ticket_seat');
        }])->where('id', $request->id)->where('bus_organization_id', auth('agent')->user()->bus_organizations_id)->firstOrFail();
        return $result;
    }

    public function store(Request $request)
    {
        $id = BusTicket::insertGetId([
            'ticket_no' => mt_rand(100000, 999999),
            'bus_schedule_id' => $request->schedule,
            'bus_boarding_id' => $request->counter,
            'customer_name' => $request->customer_name,
            'customer_phone' => $request->customer_mobile,
            'gender' => $request->gender,
            'total_seat' => count($request->seat),
            'seat_charge' => $request->seat_charge,
            'date' => $request->date,
            'status' => 'booked',
            'created_at' => now()
        ]);

        for($i=0; $i<count($request->seat); $i++){
            $seat_no[] = [
                'bus_ticket_id' => $id,
                'seat_id' => $request->seat[$i],
                'created_at' => now()
            ];
        }

        BusTicketSeat::insert($seat_no);

        BusTransection::create([
            'trxID' => Str::random(12),
            'bus_ticket_id' => $id,
            'discount' => 0,
            'service_charge' => 0,
            'total' => $request->total_charge,
            'payment_method' => 'cash'
        ]);

        $ticket = BusTicket::where('id', $id)->first();

        return redirect(route('agent.ticket.print', ['ticket' => $ticket->ticket_no]));
        // return $ticket;
    }

}
