<?php

namespace App\Http\Controllers\Admin;

use Session;
use App\Models\Feature;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FeatureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Feature::with('category')->orderBy('name');

        if($request->has('filter_category_features') && $request->get('filter_category_features') !== null) {
            Session::put('filter_category_features', $request->filter_category_features);
            $data->where('features_category_id', Session::get('filter_category_features'));
        } 
        /*else {
            Session::put('filter_category_features', 1);
        }*/

        //$data->where('features_category_id', Session::get('filter_category_features'));
        $data = $data->get();

        return view('admin.features.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.features.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->except(['_token', '_method']);

        $this->validate($request, [
            'name' => 'required',
            'features_category_id' => 'required',
        ]);

        $sort = Feature::orderBy('sort')->first();

        $input['sort'] = $sort ? (intval($sort->sort) + 1) : 1;

        $data = Feature::create($input);

        return redirect()->route('features.index')->withMessage("Successfully created record {$data->name}");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Feature::find($id);
        return view('admin.features.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Feature::find($id);
        return view('admin.features.edit', compact('data'));
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
        $data = Feature::find($id);

        $input = $request->except(['_token', '_method']);

        $this->validate($request, [
            'name' => 'required',
            'features_category_id' => 'required',
        ]);

        $data->update($input);

        return redirect()->route('features.index')->withMessage("Successfully updated record {$data->name}");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $destroy = Feature::destroy($id);
        Session::flash("message", "Successfully deleted!");
        return response()->json(["redirect" => route('features.index')]);
    }

    public function clearFilterSession() {
        Session::forget('filter_category_features');
        return redirect()->route('features.index');
    }
}
