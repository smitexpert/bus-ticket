<?php

namespace App\Http\Controllers\Admin\Bus;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\BusRoute;
use App\Agent;
use App\Bus;
use App\BusSchedule;
use App\BusCounter;
use App\BusBordingPoint;

class ScheduleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $schedules = BusSchedule::all();
        return view('admin.bus.schedule.index', compact('schedules'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'operator' => 'required',
            'route' => 'required',
            'busmodel' => 'required',
            'coach' => 'required',
            'charge' => 'required',
            'seatplan_id' => 'required',
            'total_seat' => 'required',
            'limit' => 'required',
            'dep_time' => 'required',
            'arr_time' => 'required',
            'c_arr_time' => 'required',
            'counter' => 'required'
        ]);

        $s_id = BusSchedule::insertGetId([
            'bus_organization_id' => $request->operator,
            'bus_route_id' => $request->route,
            'seat_plan_id' => $request->seatplan_id,
            'bus_id' => $request->busmodel,
            'coach' => $request->coach,
            'agent_id' => $request->agent_id,
            'bus_number' => $request->bus_number,
            'charge' => $request->charge,
            'total_seat' => $request->total_seat,
            'available_seat' => $request->total_seat,
            'limit' => $request->limit,
            'dep_time' => $request->dep_time,
            'arr_time' => $request->arr_time,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        for($i=0; $i<count($request->counter); $i++)
        {
            $counters[] = [
                'bus_schedule_id' => $s_id,
                'bus_counter_id' => $request->counter[$i],
                'arr_time' => $request->c_arr_time[$i],
                'created_at' => now()
            ];
        }

        BusBordingPoint::insert($counters);


        return back()->with('success', 'Schedule Created Successfully!');

        // return $request->all();
    }

    public function get_routes(Request $request)
    {
        $routes = BusRoute::where('bus_organization_id', $request->id)->with('from_city', 'to_city')->get();
        return $routes;
    }

    public function get_agents(Request $request)
    {
        $agents = Agent::where('bus_organizations_id', $request->id)->get();
        return $agents;
    }

    public function get_buses(Request $request)
    {
        $buses = Bus::where('bus_organization_id', $request->id)->get();
        return $buses;
    }

    public function get_seatplan(Request $request)
    {
        $seatplan = Bus::with('seatplan')->where('id', $request->id)->first();
        return $seatplan;
    }

    public function get_boarder(Request $request)
    {
        $counters = BusCounter::where('bus_organizations_id', $request->id)->get();
        return $counters;
    }
}
