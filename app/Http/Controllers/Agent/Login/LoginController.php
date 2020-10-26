<?php

namespace App\Http\Controllers\Agent\Login;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Agent;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('agent.guest:agent', ['except' => 'logout']);
    }

    // protected function guard()
    // {
    //     return Auth::guard('agent');
    // }

    public function index()
    {
        $agent = Agent::where('name');
        return view('agent.login.index');
    }

    public function attempt(Request $request)
    {
        $request->validate([
            'phone',
            'password'
        ]);

        if(Auth::guard('agent')->attempt(['phone' => $request->phone, 'password' => $request->password], $request->get('remember'))){
            return redirect()->intended(route('agent.dashboard'));
        }

        return back()->with('error', 'Login Error!');
    }
}
