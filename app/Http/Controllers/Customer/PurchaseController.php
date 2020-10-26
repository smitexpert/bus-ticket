<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\BusTicket;

class PurchaseController extends Controller
{
    public function __construct()
    {
        $this->middleware('customer.auth:customer');
    }

    public function index()
    {
        $tickets = BusTicket::with('schedule.route.from_city', 'schedule.route.to_city', 'schedule.organization', 'boarding.counter')->where('customer_phone', auth('customer')->user()->phone)->paginate(10);
        return view('customer.purchase.index', compact('tickets'));
        // return $tickets;
    }
}
