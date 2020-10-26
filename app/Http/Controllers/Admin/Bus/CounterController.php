<?php

namespace App\Http\Controllers\Admin\Bus;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Agent;
use App\BusCounter;

class CounterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $counters = BusCounter::all();
        return view('admin.bus.counter.index', compact('counters'));
    }

    public function agentByOrganization(Request $request)
    {
        $agents = Agent::where('bus_organizations_id', $request->id)->get();
        return $agents;
    }

    public function create(Request $request)
    {
        $request->validate([
            'operator' => 'required',
            'agent' => 'required',
            'counter' => 'required'
        ]);

        BusCounter::create([
            'name' => $request->counter,
            'bus_organizations_id' => $request->operator,
            'agent_id' => $request->agent
        ]);

        return back()->with('success', 'Counter Successfully Created!');
    }
}
