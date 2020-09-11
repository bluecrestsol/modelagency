<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Storage;
use App\Models\ModelsClip;
use App\Models\BooksItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ModelsClipController extends Controller
{
    public function store(Request $request, $id) {
        $this->validate($request, [
            'clips.*' => 'mimetypes:video/avi,video/mpeg,video/quicktime,video/mp4'
        ]);

        //validate

        foreach ($request->file('clips') as $key => $file) {
            list($width, $height) = getimagesize($file); //not used on clips
            // if(max($width, $height) != 600){
            //     return response()->json(['error'=>'Upload only jpg images with 600px on long size'], 422);
            // }
            $filename = md5(time().$file->getClientOriginalName()).'.'.$file->getClientOriginalExtension();
            $clip = ModelsClip::where('model_id', $id)->orderBy('order_id', 'DESC')->first();
            $order_id = $clip ? $clip->order_id : -1;
            $order_id++;

            $model_clip = ModelsClip::create([
                'model_id' => $id,
                'filename' => $filename,
                'order_id' => $order_id,
                'updated_by_admin_id' => Auth::guard('admin')->user()->id,
                'created_by_admin_id' => Auth::guard('admin')->user()->id,
            ]);

            Storage::disk('public')->putFileAs('uploads/clips/models', $file, $filename);
        }

        return json_encode(["message" => "Stored"]);

    }

    public function update(Request $request) {
        $order = $request->order;
        $sort = $this->sort($order);
        return json_encode(["message" => "Sorted"]);
    }


    public function destroy(Request $request, $id) {
        $model_clip = ModelsClip::find($id);

        Storage::disk('public')->delete('uploads/clips/models/'.$model_clip->filename);
       
       // $clips = ModelsClip::where('model_id', $request->model_id)->count();
       // $model = News::find($request->model_id);
       // $model->clips = $clips;
       // $model->save();

        $model_clip->delete();

        //delete books item
        BooksItem::where('models_clip_id', $id)->delete();

        return json_encode(["message" => "Deleted"]);

    }

    private function sort($array) {
        foreach($array as $position => $id) {
            $image = ModelsClip::find($id);
            $image->order_id = $position;
            $image->updated_by_admin_id = Auth::guard('admin')->user()->id;
            $image->save();
        }

        return true;
    }
}
