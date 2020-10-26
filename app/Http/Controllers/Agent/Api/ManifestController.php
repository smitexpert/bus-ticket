<?php

namespace App\Http\Controllers\Agent\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\BusSchedule;

class ManifestController extends Controller
{
    public function index()
    {
        $schedules = BusSchedule::with(['tickets' => function($query){
            return $query->where('date', date('Y-m-d'))->with('ticket_seat');
        }])->with('organization', 'bus.clases', 'route.from_city', 'route.to_city')->where('bus_organization_id', auth('api')->user()->bus_organizations_id)->orderBy('dep_time', 'ASC')->get();

        return response([
            'status' => 200,
            'success' => true,
            'data' => $schedules
        ], 200);
    }

    public function show($id)
    {
        $manifest = BusSchedule::with(['tickets' => function($query){
            return $query->where('date', date('Y-m-d'))->where('total_seat', '!=', 0)->with('ticket_seat', 'boarding.counter');
        }])->with('route.from_city', 'route.to_city')->where('id', $id)->where('bus_organization_id', auth('api')->user()->bus_organizations_id)->first();

        if(empty($manifest))
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
            'data' => $manifest
        ], 200);
    }
}
