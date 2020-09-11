<?php

namespace App\Http\Controllers\Admin;

use Session;
use Storage;
use App\Models\File;
use App\Models\Agency;
use App\Models\Model;
use App\Models\Customer;
use App\Models\FileType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = File::find($id);
        $disabled = true; //readonly
        $file_types = FileType::all();
        return view('admin.files.form', compact('disabled', 'data', 'file_types'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = File::find($id);
        $owner_id = $data->owner_id;
        $file_types = FileType::all();
        return view('admin.files.form', compact('data', 'file_types', 'owner_id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $file = File::find($id);
        $file->name = $request->name;
        $file->file_type_id = $request->file_type_id;
        $file->save();

        return redirect()->back()->withMessage('File updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $file = File::find($id);
        if ($file->file_type->owner_type == 2) {
            $model = Model::find($file->owner_id);
            $model->files = intval($model->files) - 1;
            $model->save();
        }
        
        Storage::delete("uploads/files/{$file->md5}");
        $file->delete();

        Session::flash('message', 'File successfully deleted!');

        //temporary redirect
        return json_encode([
            'redirect' => route('models.files.index', ['id' => $file->owner_id])
        ]);
    }

    public function download($id)
    {
        $file = File::find($id);
        $path = public_path("storage/uploads/files/{$file->md5}");


        $user = null;
        $owner_type = $file->file_type->owner_type;
        if ($owner_type == 1) {
            $user = Agency::find($file->owner_id)->name;
        } else if($owner_type == 2) {
            $user = Model::find($file->owner_id)->full_name;
        } else if($owner_type == 3) {
            $user = Customer::find($file->owner_id)->name;
        }


        $filename = "{$user} ({$file->name}).{$file->extension}";
        return response()->download($path, $filename, []);
    }
}
