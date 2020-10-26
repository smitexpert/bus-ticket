<?php

namespace App\Http\Controllers\Admin\Bus;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\BusOrganization;
use App\BusTicket;
use Yajra\DataTables\DataTables;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $organizations = BusOrganization::all();
        return view('admin.bus.reports.index', compact('organizations'));
    }

    public function get(Request $request)
    {
        

        if(!empty($request->organization) && empty($request->from_date) && empty($request->to_date))
        {
            $reports = BusTicket::whereHas('schedule.organization', function($query) use ($request){
                $query->where('id', $request->organization);
            })->with('schedule.organization', 'schedule.route.from_city', 'schedule.route.to_city')->withCount('ticket_seat')->orderBy('date', "DESC")->get();
        }
        else if(empty($request->organization) && !empty($request->from_date) && empty($request->to_date))
        {
            $reports = BusTicket::with('schedule.organization', 'schedule.route.from_city', 'schedule.route.to_city')->withCount('ticket_seat')->where('date', $request->from_date)->orderBy('date', "DESC")->get();
        }
        else if(empty($request->organization) && !empty($request->from_date) && !empty($request->to_date))
        {
            $reports = BusTicket::with('schedule.organization', 'schedule.route.from_city', 'schedule.route.to_city')->withCount('ticket_seat')->whereBetween('date', [$request->from_date, $request->to_date])->orderBy('date', "DESC")->get();
        }
        else if(!empty($request->organization) && !empty($request->from_date) && !empty($request->to_date))
        {
            $reports = BusTicket::whereHas('schedule.organization', function($query) use ($request){
                $query->where('id', $request->organization);
            })->with('schedule.organization', 'schedule.route.from_city', 'schedule.route.to_city')->withCount('ticket_seat')->whereBetween('date', [$request->from_date, $request->to_date])->orderBy('date', "DESC")->get();
        }
        else{
            $reports = BusTicket::with('schedule.organization', 'schedule.route.from_city', 'schedule.route.to_city')->withCount('ticket_seat')->orderBy('date', "DESC")->get();
        }

        return DataTables::of($reports)
        ->addColumn('operator', function($report){
            return $report->schedule->organization->name;
        })
        ->addColumn('booked', function($report){
            return $report->ticket_seat_count;
        })
        ->addColumn('route', function($report){
            return $report->schedule->route->from_city->name.'-'.$report->schedule->route->to_city->name;
        })
        ->addColumn('sold', function($report){
            return $report->seat_charge*$report->ticket_seat_count;
        })
        ->addColumn('action', function($report){
            return '<button class="btn btn-sm btn-success">Submit</button>';
        })
        ->make(true);
    }
}
