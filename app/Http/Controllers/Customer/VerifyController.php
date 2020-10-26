<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\CustomerVerify;
use App\Customer;

class VerifyController extends Controller
{
    public function __construct()
    {
        $this->middleware('customer.auth:customer');
    }

    public function index()
    {
        return view('customer.auth.verify');
    }

    public function verify(Request $request)
    {
    
        $query = CustomerVerify::where('customer_id', auth('customer')->user()->id)->first();
        if($query->verify_code == $request->verify)
        {
            Customer::where('id', auth('customer')->user()->id)->update([
                'status' => 1
            ]);
            return redirect()->intended(route('customer.dashboard'));
        }else{
            return back()->with('error', 'Wrong Code!');
        }
        // return $request->all();
    }
}
