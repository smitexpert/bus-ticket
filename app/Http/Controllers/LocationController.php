<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\District;

class LocationController extends Controller
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
