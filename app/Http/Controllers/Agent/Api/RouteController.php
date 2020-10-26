<?php

namespace App\Http\Controllers\Agent\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\BusRoute;
use App\District;

class RouteController extends Controller
{
    public function index()
    {
        $routes = BusRoute::with('from_city', 'to_city')->where('bus_organization_id', auth('api')->user()->bus_organizations_id)->get();
        return response([
            'status' => 200,
            'success' => true,
            'data' => $routes
        ], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'from' => 'required',
            'to' => 'required'
        ]);

        $route = BusRoute::create([
            'from' => $request->from,
            'to' => $request->to,
            'bus_organization_id' => auth('api')->user()->bus_organizations_id
        ]);

        return response([
            'status' => 200,
            'success' => true,
            'data' => $route
        ], 200);
    }

    public function show($id)
    {
        $route = BusRoute::with('from_city', 'to_city')->where('id', $id)->where('bus_organization_id', auth('api')->user()->bus_organizations_id)->first();
        
        if(empty($route)){
            return response([
                'status' => 404,
                'success' => true,
                'message' => "No Data Found"
            ], 404);
        }

        return response([
            'status' => 200,
            'success' => true,
            'data' => $route
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'from' => 'required',
            'to' => 'required'
        ]);

        $query = BusRoute::where('id', $id)->where('bus_organization_id', auth('api')->user()->bus_organizations_id)->update([
            'from' => $request->from,
            'to' => $request->to
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
        $query = BusRoute::where('id', $id)->where('bus_organization_id', auth('api')->user()->bus_organizations_id)->delete();

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

    public function districts()
    {
        $distritcts = District::all();
        return response([
            'status' => 200,
            'success' => true,
            'data' => $distritcts
        ], 200);
    }
}
