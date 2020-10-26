<?php

namespace App\Http\Controllers\Admin\Bus;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Bus;

class BusController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $buses = Bus::all();
        return view('admin.bus.bus.index', compact('buses'));
    }

    public function new()
    {
        return view('admin.bus.bus.new');
    }

    public function create(Request $request)
    {
        $request->validate([
            'model' => 'required',
            'class' => 'required',
            'organization' => 'required',
            'seatplan' => 'required'
        ]);

        Bus::create([
            'model' => $request->model,
            'class' => $request->class,
            'bus_organization_id' => $request->organization,
            'bus_seat_plan_id' => $request->seatplan
        ]);

        return redirect(route('admin.bus.buses'))->with('success', 'Bus Successfully Created!');
    }
}
