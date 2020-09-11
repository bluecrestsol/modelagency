<?php

namespace App\Http\Controllers\Admin;

use Storage;
use App\Models\Model;
use App\Models\FileType;
use App\Models\ModelsFile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ModelsFileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = ModelsFile::orderBy('model_id')->get();
        return view('admin.models_files.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $models = Model::orderBy('first_name', 'ASC')->get();
        $file_types = FileType::orderBy('name')->get();

        return view('admin.models_files.create', compact('models', 'file_types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
                'model_id' => 'required',
                'file_type_id' => 'required',
                'file' => 'required'
            ]);

        $file = $request->file('file');
        $md5 = md5(time().$file->getClientOriginalName());
        $extension = $file->getClientOriginalExtension();

        $model = Model::find($request->model_id);

        Storage::putFileAs('uploads/files', $request->file('file'), $md5);
        $models_file = ModelsFile::create([
                'file_type_id' => $request->file_type_id,
                'model_id' => $request->model_id,
                'md5' => $md5,
                'extension' => $extension,
                'created_by_admin_id' => auth('admin')->user()->id
            ]);

        $model->files = intval($model->files) + 1;
        $model->save();

        return redirect()->route('models_files.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $models = Model::orderBY('first_name', 'ASC')->get();
        $file_types = FileType::orderBY('name', 'ASC')->get();
        $data = ModelsFile::find($id);
        return view('admin.models_files.show', compact('models', 'file_types', 'data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $models = Model::orderBY('first_name', 'ASC')->get();
        $file_types = FileType::orderBY('name', 'ASC')->get();
        $data = ModelsFile::find($id);
        return view('admin.models_files.edit', compact('models', 'file_types', 'data'));
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
        $this->validate($request, [
                'model_id' => 'required',
                'file_type_id' => 'required',
            ]);

        $model_file = ModelsFile::find($id);

        if($request->file('file')) {
            $file = $request->file('file');
            $md5 = md5(time().$file->getClientOriginalName());
            $extension = $file->getClientOriginalExtension();
            Storage::putFileAs('uploads/files', $md5);
            Storage::delete("uploads/files/{$model_file->md5}");
            $model_file->md5 = $md5;
            $model_file->extension = $extension;
            $model_file->save();
        }

        $model_file->model_id = $request->model_id;
        $model_file->save();

        return redirect()->route('models_files.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $models_file = ModelsFile::find($id);
        $model = Model::find($models_file->model_id);
        $model->files = intval($model->file) - 1;
        $model->save();
        $models_files->delete();

        Session::flash('message', 'Model File successfully deleted!');
        return json_encode([
            'redirect' => route('models_files.index')
        ]);
    }

    public function download($id) 
    {
        $models_file = ModelsFile::find($id);
        $path = public_path("storage/uploads/files/{$models_file->md5}");
        $filename = $models_file->model->full_name.' - '.$models_file->file_type->name.'.'.$models_file->extension;
        return response()->download($path, $filename, []);
    }
}
