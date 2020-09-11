<?php

namespace App\Http\Controllers;

use App\Mail\SendContactForm;
use Carbon\Carbon;
use App\Models\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class HomePageController extends Controller
{
    
	public function index()
	{
		$available_models = Model::whereHas('availabilities', function ($query) {
			$query->where('starts_at', '<=', Carbon::now())->where('ends_at', '>=', Carbon::now());
		})->with('availabilities')->where('status', 1)->where('type', 1)->inRandomOrder()->get();

		$available_on_future = Model::whereHas('availabilities', function ($query) {
			$query->where('starts_at', '>=', Carbon::now());
		})->with('availabilities')->where('status', 1)->where('type', 1)->inRandomOrder()->get();

		$available_models = $available_models->merge($available_on_future);

		$onrequest_models = Model::doesntHave('availabilities')->where('status', 1)->where('type', 1)->inRandomOrder()->get();
		
		return view('frontend.home', compact('available_models', 'onrequest_models'));
	}

	public function sendContact(Request $request)
    {
        $customer = new \stdClass;
        $customer->name = $request->input('name') . ' ' . $request->input('last_name');
        $customer->message = $request->input('msg_txt');
        $customer->email = $request->input('email');
        $customer->subject = $request->input('subject');

        $post = [
            'secret' => '6LfU83cUAAAAAEflg0nkcNkHY0y4Osrrz7eJrGsM',
            'response' => $request->input('g-recaptcha-response')
        ];

        $ch = curl_init('https://www.google.com/recaptcha/api/siteverify');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

        $response = curl_exec($ch);

        curl_close($ch);

        $json = json_decode($response, true);

        if(!$json['success']) {
            return response()->json(['success' => false]);
        }


        Mail::to(env('CONTACT_TO','info@mpmodelsbkk.com'))->send(new SendContactForm($customer));

        return response()->json(['success' => true]);
    }

}
