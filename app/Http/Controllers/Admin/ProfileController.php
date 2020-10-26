<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Bitfumes\Multiauth\Model\Admin;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth:admin");
    }

    public function index()
    {
        $profile = auth('admin')->user();
        return view('admin.profile.profile', compact('profile'));
    }

    public function updateInfo(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'phone' => 'required|min:11|max:11',
            'email' => 'required|email|unique:admins,email,'.auth('admin')->user()->id,
            'password' => 'required|min:8'
        ]);

        $password = $request->password;
        if(Hash::check($password, auth('admin')->user()->password))
        {
            Admin::where('id', auth('admin')->user()->id)->update([
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email
            ]);
            return back()->with('success', 'Profile Information Updated!');
        }else{
            return back()->with('error', 'Current Password Not Matched!');
        }
    }
}
