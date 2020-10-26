<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Agent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginChangePassword extends Controller
{
    public function __construct()
    {
        $this->middleware('agent.auth:agent');
    }

    public function changePassword()
    {
        if(auth('agent')->user()->updated_at != null)
        {
            return redirect(route('agent.dashboard'));
        }

        return view('agent.login.change');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:8',
            're_password' => 'required'
        ]);

        if($request->password != $request->re_password)
        {
            return back()->with('error', 'Password Not Matched!');
        }

        Agent::where('id', auth('agent')->user()->id)->update([
            'password' => Hash::make($request->password)
        ]);

        return redirect(route('agent.dashboard'));
    }
}
