<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Bus;

class BusController extends Controller
{
    public function __construct()
    {
        $this->middleware('agent.auth:agent');
    }

    public function get()
    {
        $buses = Bus::where('bus_organization_id', auth('agent')->user()->bus_organizations_id)->get();
        return view('agent.bus.index', compact('buses'));
    }

    public function create()
    {
        return view('agent.bus.new');
    }

    public function store(Request $request)
    {
        $request->validate([
            'model' => 'required',
            'class' => 'required',
            'seatplan' => 'required'
        ]);

        Bus::create([
            'model' => $request->model,
            'class' => $request->class,
            'bus_seat_plan_id' => $request->seatplan,
            'bus_organization_id' => auth('agent')->user()->bus_organizations_id
        ]);

        return redirect(route('agent.buses.get'))->with('success', 'Bus Created Successfully!');
    }
}
