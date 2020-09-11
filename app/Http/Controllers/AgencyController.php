<?php

namespace App\Http\Controllers;

use Auth;
use Carbon\Carbon;
use App\Models\Agency;
use Illuminate\Http\Request;

class AgencyController extends Controller
{
    public function index() {
    	if(Auth::guard('agency')->check()) {
            return view('client.agencies.index');
        }
        return view('client.agencies.login');
    }

    public function showLoginForm() {
    	if(Auth::guard('agency')->check()) {
    		return redirect()->route('client.agencies.index');
    	}
    	return view('client.agencies.login');
    }

    public function login(Request $request) {
    	$this->validate($request, [
    		"email" => "required|email",
    		"password" => "required"
    	]);

    	$credentials = ["email" => $request->email, "password" => $request->password];
    	$remember = $request->has('remember') ? 1 : 0;

    	if(Auth::guard('agency')->attempt($credentials, $remember)) {
    		
            $agency = Agency::find(Auth::guard('agency')->user()->id);
            $agency->last_logged_at = Carbon::now();
            $agency->last_logged_geo = geoip()->getLocation(geoip()->getClientIp())->iso_code;
            $agency->save();

            return redirect()->route('client.agencies.index');
    	}
    	return redirect()->back()->withInput()->with('fail', 'Invalid credentials.');
    }

    public function logout() {
        Auth::guard('agency')->logout();
        return redirect()->route('client.agencies.index');
    }

}
