<?php

namespace App\Http\Controllers\Agent\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\BusSchedule;
use App\BusBordingPoint;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = BusSchedule::with('route.from_city', 'route.to_city')->where('bus_organization_id', auth('api')->user()->bus_organizations_id)->get();
        
        return response([
            'status' => 200,
            'success' => true,
            'data' => $schedules
        ], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'bus_route_id' => 'required',
            'seat_plan_id' => 'required',
            'bus_id' => 'required',
            'coach' => 'required',
            'charge' => 'required',
            'total_seat' => 'required',
            'arr_time' => 'required',
            'boarding_id' => 'required',
            'boarding_arr_time' => 'required'
        ]);

        $schedule = BusSchedule::create([
            'bus_organization_id' => auth('api')->user()->bus_organizations_id,
            'bus_route_id' => $request->bus_route_id,
            'seat_plan_id' => $request->seat_plan_id,
            'bus_id' => $request->bus_id,
            'coach' => $request->coach,
            'agent_id' => $request->agent_id,
            'bus_number' => $request->bus_number,
            'charge' => $request->charge,
            'total_seat' => $request->total_seat,
            'available_seat' => $request->total_seat,
            'limit' => $request->limit,
            'dep_time' => $request->dep_time,
            'arr_time' => $request->arr_time
        ]);

        for($i=0; $i<count($request->boarding_id); $i++)
        {
            $boarding_point[] = [
                'bus_schedule_id' => $schedule->id,
                'bus_counter_id' => $request->boarding_id[$i],
                'arr_time' => $request->boarding_arr_time[$i],
                'created_at' => now()
            ];
        }

        BusBordingPoint::insert($boarding_point);
        
        return response([
            'status' => 200,
            'success' => true,
            'data' => $schedule
        ], 200);
    }

    public function show($id)
    {
        $schedule = BusSchedule::with('route.from_city', 'route.to_city')->with('organization', 'route.from_city', 'route.to_city', 'bus.clases', 'bus.seatplan', 'agent', 'boarding.counter')->where('id', $id)->where('bus_organization_id', auth('api')->user()->bus_organizations_id)->first();


        
        if(empty($schedule)){
            return response([
                'status' => 404,
                'success' => true,
                'message' => "No Data Found"
            ], 404);
        }

        return response([
            'status' => 200,
            'success' => true,
            'data' => $schedule
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'bus_route_id' => 'required',
            'seat_plan_id' => 'required',
            'bus_id' => 'required',
            'coach' => 'required',
            'charge' => 'required',
            'total_seat' => 'required',
            'arr_time' => 'required',
            'boarding_id' => 'required',
            'boarding_arr_time' => 'required'
        ]);

        $query = BusSchedule::where('id', $id)->where('bus_organization_id', auth('api')->user()->bus_organizations_id)->update([
            'bus_route_id' => $request->bus_route_id,
            'seat_plan_id' => $request->seat_plan_id,
            'bus_id' => $request->bus_id,
            'coach' => $request->coach,
            'agent_id' => $request->agent_id,
            'bus_number' => $request->bus_number,
            'charge' => $request->charge,
            'total_seat' => $request->total_seat,
            'available_seat' => $request->total_seat,
            'limit' => $request->limit,
            'dep_time' => $request->dep_time,
            'arr_time' => $request->arr_time,
        ]);

        BusBordingPoint::where('bus_schedule_id', $id)->delete();

        for($i=0; $i<count($request->boarding_id); $i++)
        {
            $boarding_point[] = [
                'bus_schedule_id' => $id,
                'bus_counter_id' => $request->boarding_id[$i],
                'arr_time' => $request->boarding_arr_time[$i],
                'created_at' => now()
            ];
        }

        BusBordingPoint::insert($boarding_point);

        if(!$query)
        {
            return response([
                'status' => 400,
                'success' => false,
                'message' => 'Bad Request'
            ], 400);
        }

        return response([
            'status' => 200,
            'success' => true,
            'message' => 'Bus Updated!'
        ], 200);
    }

    public function delete($id)
    {
        $query = BusSchedule::where('id', $id)->where('bus_organization_id', auth('api')->user()->bus_organizations_id)->delete();
        if(!$query)
        {
            return response([
                'status' => 400,
                'success' => false,
                'message' => 'Bad Request'
            ], 400);
        }

        return response([
            'status' => 200,
            'success' => true,
            'message' => 'Bus Deleted!'
        ], 200);
    }
}
