<?php

namespace App\Http\Controllers\Agent\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\BusCounter;
use App\BusTicket;
use App\BusSchedule;
use App\BusBordingPoint;

class SalesReportController extends Controller
{
    public function index(Request $request)
    {
        $date = \Carbon\Carbon::today()->subDays(1);

        // $result = BusSchedule::whereHas('tickets', function($query) use ($date){
        //     $query->where('date', '>=', date('Y-m-d', strtotime($date)))->with('boarding.counter');
        // })->where('bus_organization_id', auth('api')->user()->bus_organizations_id)->get();

        // $result = BusSchedule::with(['tickets' => function($query) use ($date){
        //     return $query->where('date', '>=', date('Y-m-d', strtotime($date)))->with('boarding.counter');
        // }])->where('bus_organization_id', auth('api')->user()->bus_organizations_id)->get();

        // $result = BusBordingPoint::whereHas('schedule', function($query) use ($date){
        //     $query->where('bus_organization_id', auth('api')->user()->bus_organizations_id)->with(['tickets' => function($query) use ($date){
        //         return $query->where('date', '>=', date('Y-m-d', strtotime($date)))->with('boarding.counter');
        //     }]);
        // })->get();

        // $result = BusBordingPoint::with(['schedule' => function($query) use ($date){
        //     return $query->where('bus_organization_id', auth('api')->user()->bus_organizations_id)->with(['tickets' => function($query) use ($date){
        //         return $query->where('date', '>=', date('Y-m-d', strtotime($date)));
        //     }]);
        // }])->with('counter')->get();

        // $result = BusCounter::with('boarding.tickets.schedule')->where('bus_organizations_id', auth('api')->user()->bus_organizations_id)->get();

        if($request->has('date'))
        {
            $result = BusSchedule::with(['tickets' => function($query) use ($request){
                return $query->where('date', date('Y-m-d', strtotime($request->date)))->with('transection');
            }])->with('route.from_city', 'route.to_city')->where('bus_organization_id', auth('api')->user()->bus_organizations_id)->get();
        }else{
            $result = BusSchedule::with(['tickets' => function($query){
                return $query->where('date', '>=', date('Y-m-d'))->with('transection');
            }])->with('route.from_city', 'route.to_city')->where('bus_organization_id', auth('api')->user()->bus_organizations_id)->get();
        }
        
        
        return response([
            'status' => 200,
            'success' => true,
            'data' => $result
        ], 200);
    }
}
