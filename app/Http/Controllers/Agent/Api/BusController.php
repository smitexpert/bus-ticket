<?php

namespace App\Http\Controllers\Agent\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Bus;
use App\BusClass;
use App\BusSeatPlan;

class BusController extends Controller
{
    public function index()
    {
        $buses = Bus::with('clases', 'seatplan')->where('bus_organization_id', auth('api')->user()->bus_organizations_id)->get();
        
        return response([
            'status' => 200,
            'success' => true,
            'data' => $buses
        ], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'model' => 'required',
            'class' => 'required',
            'bus_seat_plan_id' => 'required',
        ]);

        $buses = Bus::create([
            'model' => $request->model,
            'class' => $request->class,
            'bus_seat_plan_id' => $request->bus_seat_plan_id,
            'bus_organization_id' => auth('api')->user()->bus_organizations_id
        ]);

        return response([
            'status' => 200,
            'success' => true,
            'data' => $buses
        ], 200);
    }

    public function show($id)
    {
        $buses = Bus::with('clases', 'seatplan')->where('id', $id)->where('bus_organization_id', auth('api')->user()->bus_organizations_id)->first();
        if(empty($buses)){
            return response([
                'status' => 404,
                'success' => true,
                'message' => "No Data Found"
            ], 404);
        }

        return response([
            'status' => 200,
            'success' => true,
            'data' => $buses
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'model' => 'required',
            'class' => 'required',
            'bus_seat_plan_id' => 'required',
        ]);

        $query = Bus::where('id', $id)->where('bus_organization_id', auth('api')->user()->bus_organizations_id)->update([
            'model' => $request->model,
            'class' => $request->class,
            'bus_seat_plan_id' => $request->bus_seat_plan_id
        ]);

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
        $query = Bus::where('id', $id)->where('bus_organization_id', auth('api')->user()->bus_organizations_id)->delete();
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

    public function clases()
    {
        $clases = BusClass::all();
        return response([
            'status' => 200,
            'success' => true,
            'data' => $clases
        ], 200);
    }

    public function seat_plan()
    {
        $seat_plan = BusSeatPlan::all();
        return response([
            'status' => 200,
            'success' => true,
            'data' => $seat_plan
        ], 200);
    }
}
