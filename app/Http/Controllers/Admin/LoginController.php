<?php

namespace App\Http\Controllers\Admin;

use Hash;
use Carbon\Carbon;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//Facades
use Auth;

class LoginController extends Controller
{
    public function index(){
    	if(Auth::guard('admin')->check()) {
    		return redirect()->route('admin.dashboard');
    	}

    	return view('admin.login');
    }

    public function login(Request $request) {
    	$this->validate($request, [
    		"email" => "required|email",
    		"password" => "required"
    	]);

    	$credentials = ["email" => $request->email, "password" => $request->password, "status" => 1];
    	$remember = $request->has('remember') ? 1 : 0;

    	if(Auth::guard('admin')->attempt($credentials, $remember)) {
    		
            $admin = Admin::find(Auth::guard('admin')->user()->id);
            $admin->last_logged_at = Carbon::now();
            $admin->last_logged_geo = geoip()->getLocation(geoip()->getClientIp())->iso_code;
            $admin->save();

            return redirect()->route('admin.dashboard');
    	}

        //check if disabled
        $exists = Admin::where('email', $request->email)->first();
        if ($exists) {
            if (Hash::check($request->password, $exists->password)) {
                if ($exists->status == 0) {
                    return redirect()->back()->withInput()->with('fail', 'Your account has been disabled by the administrator.');
                }
            }
        }

    	return redirect()->back()->withInput()->with('fail', 'Invalid credentials.');
    }

    public function logout() {
        Auth::guard('admin')->logout();
        return redirect()->route('admin');
    }

    public function dashboard() {
        return view('admin.dashboard');
    }
}
