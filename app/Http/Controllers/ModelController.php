<?php

namespace App\Http\Controllers;

use App\Mail\BookModel;
use Auth;
use Carbon\Carbon;
use App\Models\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ModelController extends Controller
{
    public function index() {
    	if(Auth::guard('model')->check()) {
    		return view('client.models.index');
    	}
    	return view('client.models.login');
    }

    public function showLoginForm() {
    	if(Auth::guard('model')->check()) {
    		return redirect()->route('client.models.index');
    	}
    	return view('client.models.login');
    }

    public function login(Request $request) {
    	$this->validate($request, [
    		"email" => "required|email",
    		"password" => "required"
    	]);

    	$credentials = ["email" => $request->email, "password" => $request->password];
    	$remember = $request->has('remember') ? 1 : 0;

    	if(Auth::guard('model')->attempt($credentials, $remember)) {
    		
            $model = Model::find(Auth::guard('model')->user()->id);
            $model->last_logged_at = Carbon::now();
            $model->last_logged_geo = geoip()->getLocation(geoip()->getClientIp())->iso_code;
            $model->save();

            return redirect()->route('client.models.index');
    	}
    	return redirect()->back()->withInput()->with('fail', 'Invalid credentials.');
    }

    public function logout() {
        Auth::guard('model')->logout();
        return redirect()->route('client.models.index');
    }

    public function single($uuid, $public_name)
    {
        $model = Model::where('uuid',$uuid)->first();
        $title = "{$model->public_name} - Morgan & Preston Models Bangkok";

        return view('client.models.single', compact('model', 'title'));
    }

    public function bookModel(Request $request, $uuid, $public_name)
    {
        $customer = new \stdClass;
        $customer->name = $request->input('name') . ' ' . $request->input('last_name');
        $customer->company = $request->input('company');
        $customer->mobile = $request->input('mobile');
        $customer->details = $request->input('details');
        $customer->email = $request->input('email');
        $customer->subject = 'Model Booking for ' . $public_name;

        $emails = env('BOOKING_TO', 'lisa@mpmodelsbkk.com');

        $to = explode(',', $emails);

        Mail::to($to)->send(new BookModel($customer));

        return response()->json(['success' => true]);
    }

    public function downloadCompanyCard($id)
    {
        $model = Model::find($id);
        $path = public_path("storage/uploads/photos/comp_cards/{$model->comp_card}");
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        $filename = strtoupper($model->public_name) . " - Morgan & Preston Models Bangkok.{$ext}";
        return response()->download(public_path("storage/uploads/photos/comp_cards/{$model->comp_card}"), $filename);
    }
}
