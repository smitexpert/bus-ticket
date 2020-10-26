<?php

namespace App\Http\Controllers\Admin\Bus;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\BusOrganization;
use App\Agent;
use Illuminate\Support\Facades\Hash;
use App\RoleAgent;

class AgentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $organizations = BusOrganization::all();
        $agents = Agent::all();
        return view('admin.bus.agents.index', compact('organizations', 'agents'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'password' => 'required|min:8',
            'operator' => 'required'
        ]);
        
        Agent::insert([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'bus_organizations_id' => $request->operator,
            'role_id' => 1,
            'created_at' => now()
        ]);

        return back()->with('success', 'Agent Account Created Succfully!');

        // return $request->all();
    }
}
