<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Image;
use Storage;
use App\Models\Job;
use App\Models\JobsPhoto;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class JobsPhotosController extends Controller
{
    public function store(Request $request, $id) {
        $this->validate($request, [
            'images.*' => 'mimes:jpeg,jpg'
        ]);

        //validate

        foreach ($request->file('images') as $key => $file) {
            list($width, $height) = getimagesize($file);
            // if(max($width, $height) != 600){
            //     return response()->json(['error'=>'Upload only jpg images with 600px on long size'], 422);
            // }
            $filename = md5(time().$file->getClientOriginalName()).'.jpg';
            $image = JobsPhoto::where('job_id', $id)->orderBy('sorting', 'DESC')->first();
            $sorting = $image ? $image->sorting : -1;
            $sorting++;

            $news_photo = JobsPhoto::create([
                'job_id' => $id,
                'filename' => $filename,
                'sorting' => $sorting,
                'updated_by_admin_id' => Auth::guard('admin')->user()->id,
                'created_by_admin_id' => Auth::guard('admin')->user()->id,
            ]);


            //laravel intervention image plugin
            $img = Image::make($file);
            //resize image to 800 long size
            if ($width > $height) {
                // resize the image to a width of 800 and constrain aspect ratio (auto height)
                $img = $img->resize(800, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
            } else {
                // resize the image to a height of 800 and constrain aspect ratio (auto width)
                $img = $img->resize(null, 800, function ($constraint) {
                    $constraint->aspectRatio();
                });
            }

            $img = $img->encode('jpg');

            Storage::put('uploads/photos/jobs/'.$filename, $img->__toString());
        }

        return json_encode(["message" => "Stored"]);

    }

    public function update(Request $request) {
        $order = $request->order;
        $sort = $this->sort($order);
        return json_encode(["message" => "Sorted"]);
    }


    public function destroy(Request $request, $id) {

       $news_clip = JobsPhoto::find($id);

       Storage::disk('public')->delete('uploads/photos/jobs/'.$news_clip->filename);

       $news_clip->delete();

       return json_encode(["message" => "Deleted"]);

    }

    private function sort($array) {
        foreach($array as $position => $id) {
            $image = JobsPhoto::find($id);
            $image->sorting = $position;
            $image->updated_by_admin_id = Auth::guard('admin')->user()->id;
            $image->save();
        }

        return true;
    }
}
