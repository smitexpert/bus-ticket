<?php

namespace App\Http\Controllers\Admin\Bus;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\BusOrganization;
use Image;

class OrganizationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $organizations = BusOrganization::all();
        return view('admin.bus.organization.index', compact('organizations'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required|min:11|max:11|unique:bus_organizations,phone',
            'email' => 'required|unique:bus_organizations,email'
        ]);

        $id = BusOrganization::insertGetId([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'created_by' => auth('admin')->user()->id,
            'created_at' => now()
        ]);

        if($request->hasFile('logo'))
        {
            $file = $request->file('logo');
            $uploadPath = public_path("uploaded/organizations/bus/operators");
            $logoName = $id."-".$request->name.".".$file->getClientOriginalExtension();
            $logo = $uploadPath."/".$logoName;
            Image::make($file)->save($logo);

            BusOrganization::where('id', $id)->update([
                'logo' => $logoName
            ]);

        }

        return back()->with('success', 'Organization Created Succfullay!');
    }
}
