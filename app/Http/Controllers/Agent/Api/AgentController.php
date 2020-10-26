<?php

namespace App\Http\Controllers\Agent\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Agent;
use Illuminate\Support\Facades\Hash;

class AgentController extends Controller
{
    public function index()
    {
        $agents = Agent::where('bus_organizations_id', auth('api')->user()->bus_organizations_id)->get();
        return response([
            'success' => true,
            'status' => 200,
            'data' => $agents
        ], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'phone' => 'required|unique:agents,phone',
            'password' => 'required',
            'role_id' => 'required'
        ]);

        $agent = Agent::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
            'bus_organizations_id' => auth('api')->user()->bus_organizations_id
        ]);

        $data = $agent;

        return response([
            'success' => true,
            'status' => 200,
            'data' => $data
        ], 200);
        
    }

    public function show($id)
    {
        $agent = Agent::where('id', $id)->where('bus_organizations_id', auth('api')->user()->bus_organizations_id)->first();
        if(empty($agent)){
            return response([
                'success' => false,
                'status' => 404,
                'data' => 'Agent Not Found'
            ], 404);
        }

        return response([
            'success' => true,
            'status' => 200,
            'data' => $agent
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|min:3',
            'phone' => 'required|unique:agents,phone,'.$id,
            'role_id' => 'required'
        ]);
        
        Agent::where('id', $id)->where('bus_organizations_id', auth('api')->user()->bus_organizations_id)->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'role_id' => $request->role_id
        ]);

        return response([
            'status' => 200,
            'success' => true,
            'message' => 'Agent Updated'
        ], 200);
        
    }

    public function delete($id)
    {
        $delete = Agent::where('id', $id)->where('bus_organizations_id', auth('api')->user()->bus_organizations_id)->delete();
       if(!$delete)
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
            'message' => 'Agent Deleted'
        ], 200);
    }


}
