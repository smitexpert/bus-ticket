<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Agent;

class CheckRoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('agent.auth:agent');
        $this->middleware('agent_role:counter');
    }

    public function get()
    {
        $role = auth('agent')->user()->roles()->first();
        return $role->name;
    }
}
