<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\BusSchedule;
use App\Bus;
use App\BusBordingPoint;

class ScheduleController extends Controller
{
    public function __construct()
    {
        $this->middleware('agent.auth:agent');
    }

    public function get()
    {
        $schedules = BusSchedule::where('bus_organization_id', auth('agent')->user()->bus_organizations_id)->get();
        return view('agent.schedule.index', compact('schedules'));
    }

    public function get_seat_plan(Request $request)
    {
        $bus = Bus::with('seatplan')->where('id', $request->id)->first();
        return $bus;
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
    }
}
