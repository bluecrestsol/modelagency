<?php

namespace App\Http\Controllers\Admin;

use Session;
use Carbon\Carbon;
use App\Models\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = News::orderBy('title', 'ASC')->get();
        return view('admin.news.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.news.create');
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
            'published_at' => 'required'
        ]);

        $data = $request->except(['_token', '_method']);
        $data['published_at'] = Carbon::parse($request->published_at);
        $data['created_by_admin_id'] = auth('admin')->user()->id;
        $data['updated_by_admin_id'] = auth('admin')->user()->id;
        $create = News::create($data);

        return redirect()->route('news.index')->withMessage("Successfully created!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = News::find($id);

        return view('admin.news.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = News::find($id);

        return view('admin.news.edit', compact('data'));
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
        ]);

        $edit = News::find($id);

        $data = $request->except(['_token', '_method']);
        $data['published_at'] = Carbon::parse($request->published_at);
        $data['updated_by_admin_id'] = auth('admin')->user()->id;
        $edit = $edit->update($data);

        return redirect()->route('news.index')->withMessage("Successfully updated!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $destroy = News::destroy($id);
        Session::flash("message", "Successfully deleted!");
        return response()->json(["redirect" => route('news.index')]);
    }

    public function images($id) 
    {
        $data = News::with('news_photos')->find($id);
        $images = $data->news_photos;
        return view('admin.news.images', compact('images','data'));
    }

    public function clips($id) 
    {
        $data = News::with('news_clips')->find($id);
        $clips = $data->news_clips;
        return view('admin.news.clips', compact('clips','data'));
    }
}
