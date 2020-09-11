<?php

namespace App\Http\Controllers\Admin;

use Mail;
use App\Models\Setting;
use App\Models\Enquiry;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EnquiryController extends Controller
{
    public function index()
    {
    	$data = Enquiry::orderBy('created_at', 'DESC')->get();
    	return view('admin.enquiries.index', compact('data'));
    }

    public function create()
    {

    }

    public function store(Request $request)
    {
    	$this->validate($request, [
    		'from_name' => 'required',
    		'from_company' => 'required',
    		'from_email' => 'required',
    		'from_mobile' => 'required',
    		'message' => 'required',

    	]);

    	$data = $request->except(['_token']);

    	$data['from_ip'] = geoip()->getClientIP();
    	$data['from_geo_country_iso'] = geoip()->getLocation(geoip()->getClientIp())->iso_code;
    	$data['uuid'] = $this->generate_uuid();

    	$enquiry = Enquiry::create($data);

    	$enquiry = Enquiry::find($enquiry->id);
    	//send email to sender
    	Mail::send('admin.emails.enquiry-sender', ['enquiry' => $enquiry], function ($m) use ($enquiry) {
    	            $m->from('no-reply@mpmodelsbkk.com', 'Morgan & Preston Models');
    	            $m->to($enquiry->from_email, $enquiry->from_name)->subject('Thanks for your enquiry');
    	        });


    	

    	//send email to admin
    	$setting = Setting::where('name', 'booking_enquiries_sent_to')->first();
    	$emails = explode(",", $setting->setting);

    	foreach($emails as $s) {
    		Mail::send('admin.emails.enquiry-sender', ['enquiry' => $enquiry], function ($m) use ($enquiry, $s) {
    		            $m->from('no-reply@mpmodelsbkk.com', 'Morgan & Preston Models');
    		            $m->to($s, 'booking_enquiries_sent_to')->subject("New enquiry for model {$enquiry->model->public_name}");
    		        });
    	}
    	

    	return response()->json(['Message' => 'Emails Sent']);
    }

    public function show($id) 
    {
    	$data = Enquiry::find($id);
    	return view('admin.enquiries.show', compact('data'));
    }

    public function destroy($id)
    {
        if (auth('admin')->user()->role != 1) return redirect()->route('admin');

        $data = Enquiry::find($id);
        $data->delete();
        return redirect()->route('enquiries.index')->with('success', 'Enquiry successfully removed');
    }

    private function generate_uuid()
    {
        $uuid = strtolower(str_random(8));
        if( Enquiry::where('uuid', $uuid)->first() ) {
            return $this->generate_uuid();
        }
        return $uuid;
    }
}
