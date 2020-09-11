<?php

namespace App\Http\Controllers\Admin;

use Storage;
use Session;
use Carbon\Carbon;
use App\Models\Job;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class JobsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Job::orderBy('title', 'ASC')->get();
        return view('admin.jobs.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.jobs.create');
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
            'title' => 'required',
            'published_at' => 'required',
            'thumb' => 'required|mimes:jpeg,jpg|dimensions:width=600,height=800'
        ]);

        $model_ids = [];

        if ($request->model1_id !== null) $model_ids[] = $request->model1_id;
        if ($request->model2_id !== null) $model_ids[] = $request->model2_id;
        if ($request->model3_id !== null) $model_ids[] = $request->model3_id;

        //check if < 1 or >3
        if (count($model_ids) < 1 || count($model_ids) > 3) {
            return redirect()->back()->with('error', 'Please select at least one model')->withInput();
        }

        //check if there are no duplicates
        if (count($model_ids) > count(array_flip($model_ids))) {
            return redirect()->back()->with('error', 'You can only select a model once')->withInput();
        }

        //thumb
        $thumb = $request->file('thumb');
        $filename = md5(time().$thumb->getClientOriginalName()).'.jpg';

        Storage::disk('public')->putFileAs('uploads/thumbs/jobs', $thumb, $filename);

        $data = $request->except(['_token', '_method', 'thumb']);

        $data['thumb'] = $filename;
        $data['published_at'] = Carbon::parse($request->published_at);
        $data['created_by_admin_id'] = auth('admin')->user()->id;
        $data['updated_by_admin_id'] = auth('admin')->user()->id;
        $create = Job::create($data);

        return redirect()->route('jobs.index')->withMessage("Successfully created!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Job::find($id);

        return view('admin.jobs.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Job::find($id);

        return view('admin.jobs.edit', compact('data'));
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
            'title' => 'required',
            'published_at' => 'required',
            'thumb' => 'mimes:jpeg,jpg|dimensions:width=600,height=800'
        ]);

        $edit = Job::find($id);

        $data = $request->except(['_token', '_method', 'thumb']);

        $model_ids = [];

        if ($request->model1_id !== null) $model_ids[] = $request->model1_id;
        if ($request->model2_id !== null) $model_ids[] = $request->model2_id;
        if ($request->model3_id !== null) $model_ids[] = $request->model3_id;

        //check if < 1 or >3
        if (count($model_ids) < 1 || count($model_ids) > 3) {
            return redirect()->back()->with('error', 'Please select at least one model')->withInput();
        }

        //check if there are no duplicates
        if (count($model_ids) > count(array_flip($model_ids))) {
            return redirect()->back()->with('error', 'You can only select a model once')->withInput();
        }

        if ($request->hasFile('thumb')) {
            //delete old
            if ($edit->thumb !== null) {
                Storage::disk('public')->delete('uploads/thumbs/jobs/'.$edit->thumb);    
            }
            
            //new thumb
            $thumb = $request->file('thumb');
            $filename = md5(time().$thumb->getClientOriginalName()).'.jpg';

            Storage::disk('public')->putFileAs('uploads/thumbs/jobs', $thumb, $filename);

            $data['thumb'] = $filename;
        }
        
        $data['published_at'] = Carbon::parse($request->published_at);
        $data['updated_by_admin_id'] = auth('admin')->user()->id;
        $edit = $edit->update($data);

        return redirect()->route('jobs.index')->withMessage("Successfully updated!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $destroy = Job::destroy($id);
        Session::flash("message", "Successfully deleted!");
        return response()->json(["redirect" => route('jobs.index')]);
    }

    public function images($id) 
    {
        $data = Job::with('jobs_photos')->find($id);
        $images = $data->jobs_photos()->orderBy('sorting')->get();
        return view('admin.jobs.images', compact('images','data'));
    }

    public function clips($id) 
    {
        $data = Job::with('jobs_clips')->find($id);
        $clips = $data->jobs_clips;
        return view('admin.jobs.clips', compact('clips','data'));
    }
}
