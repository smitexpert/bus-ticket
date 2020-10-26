<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{

    protected $redirectTo = '/agent/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('agent.auth:agent');
        $this->middleware('agent.check.pass');
    }

    /**
     * Show the Agent dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        if(auth('agent')->user()->role_id == 1)
        {
            return view('agent.dashboard');
        }else if(auth('agent')->user()->role_id == 2){
            return view('agent.counter_view.index');
        }
        // return auth('agent')->user()->name;
    }

}