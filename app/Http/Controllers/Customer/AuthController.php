<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Customer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\CustomerVerify;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('customer.guest:customer', ['except' => 'logout']);
    }

    public function create(Request $request)
    {
        $request->validate([
            'password' => 'required|min:8',
            'phone' => 'required|min:11|max:11|unique:customers,phone',
            'name' => 'required|min:3'
        ]);

        $id = Customer::insertGetId([
            'name' => $request->name,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'created_at' => now()
        ]);

        CustomerVerify::insert([
            'verify_code' => 123456,
            'customer_id' => $id
        ]);
        
        if(Auth::guard('customer')->attempt(['phone' => $request->phone, 'password' => $request->password], $request->get('remember'))){
            return redirect()->intended(route('customer.dashboard'));
        }
        
    }

    public function attempt(Request $request)
    {
        if(Auth::guard('customer')->attempt(['phone' => $request->phone, 'password' => $request->password], $request->get('remember'))){
            return redirect()->intended(route('customer.dashboard'));
        }

        return back()->with('error', 'User Password Not Matched!');
    }
}
