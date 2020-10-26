<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\BusRoute;

class RouteController extends Controller
{
    public function __construct()
    {
        $this->middleware('agent.auth:agent');
    }

    public function get()
    {
        $routes = BusRoute::where('bus_organization_id', auth('agent')->user()->bus_organizations_id)->get();
        return view('agent.routes.index', compact('routes'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'from' => 'required',
            'to' => 'required'
        ]);

        BusRoute::create([
            'from' => $request->from,
            'to' => $request->to,
            'bus_organization_id' => auth('agent')->user()->bus_organizations_id
        ]);

        return back()->with('success', 'Route Created Susscessfully!');
    }
}
