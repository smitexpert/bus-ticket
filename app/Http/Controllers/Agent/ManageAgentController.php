<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Agent;
use Illuminate\Support\Facades\Hash;
use App\AgentRole;

class ManageAgentController extends Controller
{
    public function __construct()
    {
        $this->middleware('agent.auth:agent');
    }

    public function index()
    {
        $id = auth('agent')->user()->bus_organizations_id;
        $agents = Agent::where('bus_organizations_id', $id)->get();
        $roles = AgentRole::all();
        return view('agent.manage.index', compact('agents', 'roles'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required|unique:agents,phone',
            'email' => '',
            'password' => 'required'
        ]);

        Agent::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'bus_organizations_id' => auth('agent')->user()->bus_organizations_id,
            'role_id' => $request->role
        ]);


        return back()->with('success', 'Agent Successfully Created');
    }
}
