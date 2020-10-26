<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\BusTicket;
use App\BusRoute;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('agent.auth:agent');
    }

    public function index()
    {
        $routes = BusRoute::with('from_city', 'to_city')->where('bus_organization_id', auth('agent')->user()->bus_organizations_id)->get();
        return view('agent.reports.index', compact('routes'));
    }

    public function get(Request $request)
    {

        if(!empty($request->route))
        {
            $reports = BusTicket::whereHas('schedule', function($query) use ($request) {
                $query->where('bus_route_id', $request->route)->where('bus_organization_id', auth('agent')->user()->bus_organizations_id);
            })->with('schedule.route.from_city', 'schedule.route.to_city')->withCount('ticket_seat')->get();
        }
        else if(!empty($request->from_date) && empty($request->to_date)){
            $reports = BusTicket::whereHas('schedule', function($query) {
                $query->where('bus_organization_id', auth('agent')->user()->bus_organizations_id);
            })->with('schedule.route.from_city', 'schedule.route.to_city')->withCount('ticket_seat')->where('date', $request->from_date)->get();
        }
        else if(!empty($request->from_date) && !empty($request->to_date)){
            $reports = BusTicket::whereHas('schedule', function($query) {
                $query->where('bus_organization_id', auth('agent')->user()->bus_organizations_id);
            })->with('schedule.route.from_city', 'schedule.route.to_city')->withCount('ticket_seat')->whereBetween('date', [$request->from_date, $request->to_date])->get();
        }
        
        else{
            $reports = BusTicket::whereHas('schedule', function($query) {
                $query->where('bus_organization_id', auth('agent')->user()->bus_organizations_id);
            })->with('schedule.route.from_city', 'schedule.route.to_city')->withCount('ticket_seat')->get();
        }
        

        // return dd($reports);
        return DataTables::of($reports)
        ->addColumn('booked', function($report){
            return $report->ticket_seat_count;
        })
        ->addColumn('route', function($report){
            return $report->schedule->route->from_city->name.'-'.$report->schedule->route->to_city->name;
        })
        ->addColumn('sold', function($report){
            return $report->seat_charge*$report->ticket_seat_count;
        })
        ->addColumn('coach', function($report){
            return $report->schedule->coach;
        })
        ->addColumn('status', function($report){
            return $report->status;
        })
        ->addColumn('action', function($report){
            return '<button class="btn btn-sm btn-success">Submit</button>';
        })
        ->make(true);
    }
}
