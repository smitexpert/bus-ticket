<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\District;

class LocationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $districts = District::all();
        return view('admin.location.index', compact('districts'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:districts,name'
        ]);

        $user = auth('admin')->user()->id;

        $insert = District::create([
            'name' => $request->name,
            'created_by' => $user
        ]);

        if($insert)
        {
            return back()->with('success', 'Successfully Created!');
        }else{
            return back()->with('error', 'Something Wrong!');
        }

        
        
    }

    public function get()
    {
        $data = District::all();
        return $data;
    }
}
