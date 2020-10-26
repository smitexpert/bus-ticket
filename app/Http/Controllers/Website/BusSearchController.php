<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\District;

class BusSearchController extends Controller
{
    public function __construct()
    {
        
    }

    public function location()
    {
        $data = District::all();
        return $data;
    }
}
