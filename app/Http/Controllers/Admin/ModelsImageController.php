<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Input;
use Image;
use Storage;
use App\Models\Model;
use App\Models\BooksItem;
use App\Models\ModelsImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ModelsImageController extends Controller
{
    public function __construct() {
    	// $this->middleware('auth:admin');
    }

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
    		$image = ModelsImage::where('model_id', $id)->orderBy('sorting', 'DESC')->first();
    		$sorting = $image ? $image->sorting : -1;
    		$sorting++;

    		$model_image = ModelsImage::create([
    			'model_id' => $id,
    			'filename' => $filename,
    			'sorting' => $sorting,
                'updated_by_admin_id' => Auth::guard('admin')->user()->id,
                'created_by_admin_id' => Auth::guard('admin')->user()->id,
                'type' => $request->type
    		]);

            //update models photos
            $photos = ModelsImage::where('model_id', $id)->count();
            $model = Model::find($id);
            $model->photos = $photos;
            $model->save();


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

    		Storage::put('uploads/photos/'.$filename, $img->__toString());
    	}

    	return json_encode(["message" => "Stored"]);

    }

    public function update(Request $request) {
    	$order = $request->order;
        $sort = $this->sort($order);
    	return json_encode(["message" => $order]);
    }


    public function destroy(Request $request, $id) {

    	$image = ModelsImage::find($id);
        $image->delete();
         //delete image
        unlink(storage_path('app/public/uploads/photos/'.$image->filename));
        //delete bookitem
        BooksItem::where('models_photo_id', $id)->delete();

       //update models photos
       $photos = ModelsImage::where('model_id', $request->model_id)->count();
       $model = Model::find($request->model_id);
       $model->photos = $photos;
       $model->save();

        return json_encode(["message" => "Deleted"]);

    }

    private function sort($array) {
    	foreach($array as $position => $id) {
    		$image = ModelsImage::find($id);
            $image->sorting = $position;
    		$image->updated_by_admin_id = Auth::guard('admin')->user()->id;
    		$image->save();
    	}

    	return true;
    }
}
