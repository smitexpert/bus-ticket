<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\BusSchedule;

class ManifastController extends Controller
{
    public function __construct()
    {
        $this->middleware('agent.auth:agent');
    }

    public function index()
    {
        $schedules = BusSchedule::with(['tickets' => function($query){
            return $query->where('date', date('Y-m-d'))->with('ticket_seat');
        }])->with('organization', 'bus.clases', 'route.from_city', 'route.to_city')->where('bus_organization_id', auth('agent')->user()->bus_organizations_id)->orderBy('dep_time', 'ASC')->get();
        
        // return dd($schedules);
        return view('agent.manifest.index', compact('schedules'));
    }

    public function view($id)
    {
        $manifest = BusSchedule::with(['tickets' => function($query){
            return $query->where('date', date('Y-m-d'))->where('total_seat', '!=', 0)->with('ticket_seat', 'boarding.counter');
        }])->with('route.from_city', 'route.to_city')->where('id', $id)->where('bus_organization_id', auth('agent')->user()->bus_organizations_id)->firstOrFail();

        // return dd($manifest);
        return view('agent.manifest.print', compact('manifest'));
    }

     public function counter()
    {
        // $schedules = BusSchedule::whereHas('tickets.boarding.counter', function($query){
        //     $query->where('agent_id', auth('agent')->user()->id);
        // })->with('tickets.ticket_seat', 'organization', 'bus.clases', 'route.from_city', 'route.to_city')->where('bus_organization_id', auth('agent')->user()->bus_organizations_id)->orderBy('dep_time', 'ASC')->get();

        $schedules = BusSchedule::whereHas('tickets.boarding.counter', function($query){
            $query->where('agent_id', auth('agent')->user()->id);
        })->with(['tickets' => function($query){
            return $query->where('date', date('Y-m-d'))->where('total_seat', '!=', 0)->with('ticket_seat', 'boarding.counter');
        }])->with('organization', 'bus.clases', 'route.from_city', 'route.to_city')->where('bus_organization_id', auth('agent')->user()->bus_organizations_id)->orderBy('dep_time', 'ASC')->get();
        
        return dd($schedules);
        // return view('agent.manifest.index', compact('schedules'));
    }
}
