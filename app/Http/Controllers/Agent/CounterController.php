<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\BusCounter;

class CounterController extends Controller
{
    public function __construct()
    {
        $this->middleware('agent.auth:agent');
    }

    public function get()
    {
        $counters = BusCounter::where('bus_organizations_id', auth('agent')->user()->bus_organizations_id)->get();
        return view('agent.counter.index', compact('counters'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'agent' => 'required',
            'counter' => 'required'
        ]);

        BusCounter::create([
            'name' => $request->counter,
            'agent_id' => $request->agent,
            'bus_organizations_id' => auth('agent')->user()->bus_organizations_id
        ]);

        return back()->with('success', 'Counter Successfully Created!');
    }
    
}
