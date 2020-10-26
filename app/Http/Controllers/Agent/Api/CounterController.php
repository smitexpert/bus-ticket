<?php

namespace App\Http\Controllers\Agent\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\BusCounter;

class CounterController extends Controller
{
    public function index()
    {
        $counters = BusCounter::with('agent')->where('bus_organizations_id', auth('api')->user()->bus_organizations_id)->get();
                
        return response([
            'status' => 200,
            'success' => true,
            'data' => $counters
        ], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'agent_id' => 'required'
        ]);

        $counter = BusCounter::create([
            'name' => $request->name,
            'bus_organizations_id' => auth('api')->user()->bus_organizations_id,
            'agent_id' => $request->agent_id
        ]);

        return response([
            'status' => 200,
            'success' => true,
            'data' => $counter
        ], 200);
    }

    public function show($id)
    {
        $counter = BusCounter::with('agent')->where('id', $id)->where('bus_organizations_id', auth('api')->user()->bus_organizations_id)->first();

        if(empty($counter)){
            return response([
                'status' => 404,
                'success' => true,
                'message' => "No Data Found"
            ], 404);
        }

        return response([
            'status' => 200,
            'success' => true,
            'data' => $counter
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'agent_id' => 'required'
        ]);

        $query = BusCounter::where('id', $id)->where('bus_organizations_id', auth('api')->user()->bus_organizations_id)->update([
            'name' => $request->name,
            'agent_id' => $request->agent_id
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
            'message' => 'Counter Updated!'
        ], 200);
    }

    public function delete($id)
    {
        $query = BusCounter::where('id', $id)->where('bus_organizations_id', auth('api')->user()->bus_organizations_id)->delete();

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
            'message' => 'Counter Deleted!'
        ], 200);
    }
}
