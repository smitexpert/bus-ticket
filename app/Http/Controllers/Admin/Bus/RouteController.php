<?php

namespace App\Http\Controllers\Admin\Bus;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\BusRoute;

class RouteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $routes = BusRoute::all();
        return view('admin.bus.routes.index', compact('routes'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'from' => 'required',
            'to' => 'required',
            'operator' => 'required'
        ]);

        BusRoute::create([
            'from' => $request->from,
            'to' => $request->to,
            'bus_organization_id' => $request->operator
        ]);

        return back()->with('success', 'Route Created Successfully!');
    }
}
