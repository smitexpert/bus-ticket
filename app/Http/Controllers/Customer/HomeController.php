<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{

    protected $redirectTo = '/customer/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('customer.auth:customer');
    }

    /**
     * Show the Customer dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('customer.home');
    }

}