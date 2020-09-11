<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Storage;
use App\Models\JobsClip;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class JobsClipsController extends Controller
{
    
	public function store(Request $request, $id) {
	    $this->validate($request, [
	        'clips.*' => 'mimetypes:video/avi,video/mpeg,video/quicktime,video/mp4'
	    ]);

	    //validate

	    foreach ($request->file('clips') as $key => $file) {
	        list($width, $height) = getimagesize($file);
	        // if(max($width, $height) != 600){
	        //     return response()->json(['error'=>'Upload only jpg images with 600px on long size'], 422);
	        // }
	        $filename = md5(time().$file->getClientOriginalName()).'.'.$file->getClientOriginalExtension();
	        $clip = JobsClip::where('job_id', $id)->orderBy('order_id', 'DESC')->first();
	        $order_id = $clip ? $clip->order_id : -1;
	        $order_id++;

	        $news_clip = JobsClip::create([
	            'job_id' => $id,
	            'filename' => $filename,
	            'order_id' => $order_id,
	            'updated_by_admin_id' => Auth::guard('admin')->user()->id,
	            'created_by_admin_id' => Auth::guard('admin')->user()->id,
	        ]);

	        Storage::disk('public')->putFileAs('uploads/clips/jobs', $file, $filename);
	    }

	    return json_encode(["message" => "Stored"]);

	}

	public function update(Request $request) {
	    $order = $request->order;
	    $sort = $this->sort($order);
	    return json_encode(["message" => "Sorted"]);
	}


	public function destroy(Request $request, $id) {
	    $news_clip = JobsClip::find($id);

	    Storage::disk('public')->delete('uploads/clips/jobs/'.$news_clip->filename);
	   
	   // $clips = NewsClip::where('news_id', $request->news_id)->count();
	   // $model = News::find($request->news_id);
	   // $model->clips = $clips;
	   // $model->save();

	    $news_clip->delete();

	    return json_encode(["message" => "Deleted"]);

	}

	private function sort($array) {
	    foreach($array as $position => $id) {
	        $image = JobsClip::find($id);
	        $image->order_id = $position;
	        $image->updated_by_admin_id = Auth::guard('admin')->user()->id;
	        $image->save();
	    }

	    return true;
	}

}
