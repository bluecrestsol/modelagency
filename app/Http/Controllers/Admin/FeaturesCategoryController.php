<?php

namespace App\Http\Controllers\Admin;

use Session;
use App\Models\Feature;
use Illuminate\Http\Request;
use App\Models\FeaturesCategory;
use App\Http\Controllers\Controller;

class FeaturesCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = FeaturesCategory::orderBy('seq')->get();
        return view('admin.features_categories.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.features_categories.create');
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
        ]);

        $data = FeaturesCategory::create($input);

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
        $data = FeaturesCategory::find($id);
        return view('admin.features_categories.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = FeaturesCategory::find($id);
        return view('admin.features_categories.edit', compact('data'));
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
        $data = FeaturesCategory::find($id);

        $input = $request->except(['_token', '_method']);

        $this->validate($request, [
            'name' => 'required',
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
        try {
            
            $destroy = FeaturesCategory::destroy($id);
            Session::flash("message", "Successfully deleted!");
            return response()->json(["redirect" => route('features.index')]);

        } catch ( \Illuminate\Database\QueryException $e) {
            Session::flash("error", "Features exist within this category! Failed to delete.");
            return response()->json(["redirect" => route('features.index')]);
        }
        

    }

    public function features($category_id)
    {
        $data = Feature::where('features_category_id', $category_id)->orderBy('name')->get();
        $category = FeaturesCategory::find($category_id);
        return view('admin.features.index', compact('data', 'category'));
    }

    public function showFeature($id)
    {
        $data = Feature::find($id);
        return view('admin.features.show', compact('data'));
    }

    public function editFeature($id)
    {
        $data = Feature::find($id);
        return view('admin.features.edit', compact('data'));
    }

    public function createFeature($category_id)
    {
        $category = FeaturesCategory::find($category_id);
        return view('admin.features.create', compact('category'));
    }

    public function storeFeature(Request $request)
    {
        $input = $request->except(['_token', '_method']);

        $this->validate($request, [
            'name' => 'required',
            'features_category_id' => 'required',
        ]);

        $sort = Feature::orderBy('sort')->first();

        $input['sort'] = $sort ? (intval($sort->sort) + 1) : 1;

        $data = Feature::create($input);

        return redirect()->route('features.list', $data->features_category_id)->withMessage("Successfully created record {$data->name}");
    }

    public function destroyFeature($id)
    {
        $destroy = Feature::find($id);
        $destroy->delete();
        Session::flash("message", "Successfully deleted!");
        return response()->json(["redirect" => route('features.list', $destroy->features_category_id)]);
    }

    public function updateFeature(Request $request, $id)
    {
        $data = Feature::find($id);

        $input = $request->except(['_token', '_method']);

        $this->validate($request, [
            'name' => 'required',
            'features_category_id' => 'required',
        ]);

        $data->update($input);

        return redirect()->route('features.list', $data->features_category_id)->withMessage("Successfully updated record {$data->name}");
    }

    public function reorder(Request $request)
    {

        $data = FeaturesCategory::orderBy('seq')->get();
        $seq = [];
        
        foreach ($data as $item) {
            $seq[$item->seq] = $item->seq;
        }

        $input = $request->result;

        foreach ($input as $i) {
            $seq[$i['old']] = intval($i['new']);
        }

        //update db
        foreach ($data as $key => $value) {
            $i = FeaturesCategory::find($value->id);
            $i->seq = $seq[$i->seq];
            $i->save();
        }

        return response()->json(['success' => 1, 'message' => 'sorted']);
    }
}
