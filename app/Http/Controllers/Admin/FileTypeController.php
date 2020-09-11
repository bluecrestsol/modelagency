<?php

namespace App\Http\Controllers\Admin;

use Session;
use App\Models\FileType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class FileTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = FileType::orderBy('name');

        //filter
        if($request->has('filter_owner_file_types')) Session::put('filter_owner_file_types', $request->filter_owner_file_types);

        if(Session::has('filter_owner_file_types'))
            $data = $data->where('owner_type', Session::get('filter_owner_file_types'));

        $data = $data->get();

        //end filter
        
        return view('admin.file_types.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.file_types.create');
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
            'name' => 'required',
            'owner' => 'required',
        ]);

        $data['name'] = $request->name;
        $data['owner_type'] = $request->owner;

        $file_type = FileType::create($data);

        return redirect()->route('file_types.index')->withMessage('File type successfully created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = FileType::find($id);
        return view('admin.file_types.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = FileType::find($id);
        return view('admin.file_types.edit', compact('data'));
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
            'name' => 'required',
            'owner' => 'required',
         ]);

        $file_type = FileType::find($id);

        $file_type->name = $request->name;
        $file_type->owner_type = $request->owner;
        $file_type->save();

        return redirect()->route('file_types.index')->withMessage('File type successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        FileType::destroy($id);

        return json_encode([
            'redirect' => route('file_types.index')
        ]);
    }

    public function clearFilterSession() {
        Session::forget('filter_owner_file_types');
        return redirect()->route('file_types.index');
    }
}
