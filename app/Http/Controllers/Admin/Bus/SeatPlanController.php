<?php

namespace App\Http\Controllers\Admin\Bus;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\BusSeatPlan;

class SeatPlanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $types = BusSeatPlan::all();
        return view('admin.bus.seatplan.index', compact('types'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'type' => 'required'
        ]);
        
        BusSeatPlan::create([
            'type' => $request->type
        ]);

        return back()->with('success', 'Seat Plan Created Successfully!');
    }
}
