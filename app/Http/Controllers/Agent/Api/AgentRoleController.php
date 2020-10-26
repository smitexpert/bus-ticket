<?php

namespace App\Http\Controllers\Agent\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\AgentRole;

class AgentRoleController extends Controller
{
    public function index()
    {
        $roles = AgentRole::get();
        return response([
            'success' => true,
            'status' => 200,
            'data' => $roles
        ], 200);
    }
}
