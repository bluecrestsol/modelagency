<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Image;
use Storage;
use App\Models\News;
use App\Models\NewsPhoto;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewsPhotoController extends Controller
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
            $image = NewsPhoto::where('news_id', $id)->orderBy('order_id', 'DESC')->first();
            $order_id = $image ? $image->order_id : -1;
            $order_id++;

            $news_photo = NewsPhoto::create([
                'news_id' => $id,
                'filename' => $filename,
                'order_id' => $order_id,
                'updated_by_admin_id' => Auth::guard('admin')->user()->id,
                'created_by_admin_id' => Auth::guard('admin')->user()->id,
            ]);


            //laravel intervention image plugin
            $img = Image::make($file);
            //resize image to 600 long size
            if ($width > $height) {
                // resize the image to a width of 600 and constrain aspect ratio (auto height)
                $img = $img->resize(600, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
            } else {
                // resize the image to a height of 600 and constrain aspect ratio (auto width)
                $img = $img->resize(null, 600, function ($constraint) {
                    $constraint->aspectRatio();
                });
            }

            $img = $img->encode('jpg');

            Storage::put('uploads/photos/news/'.$filename, $img->__toString());
        }

        return json_encode(["message" => "Stored"]);

    }

    public function update(Request $request) {
        $order = $request->order;
        $sort = $this->sort($order);
        return json_encode(["message" => "Sorted"]);
    }


    public function destroy(Request $request, $id) {
        NewsPhoto::destroy($id);
        
       //update models photos
       $photos = NewsPhoto::where('news_id', $request->news_id)->count();
       $model = News::find($request->news_id);
       $model->photos = $photos;
       $model->save();

        return json_encode(["message" => "Deleted"]);

    }

    private function sort($array) {
        foreach($array as $position => $id) {
            $image = NewsPhoto::find($id);
            $image->order_id = $position;
            $image->updated_by_admin_id = Auth::guard('admin')->user()->id;
            $image->save();
        }

        return true;
    }
}
