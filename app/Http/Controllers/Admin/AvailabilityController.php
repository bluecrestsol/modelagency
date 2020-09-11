<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Auth;
use Session;
use Carbon\Carbon;
use App\Models\Availability;
use App\Http\Controllers\Controller;

class AvailabilityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'starts_at' => 'required',
            'ends_at' => 'required',
        ]);

        $availability = Availability::create([
            'created_by_admin_id' => Auth::guard('admin')->user()->id,
            'model_id' => $request->model_id,
            'starts_at' => Carbon::parse($request->starts_at),
            'ends_at' => Carbon::parse($request->ends_at),
            'type' => $request->type,
        ]);

        return redirect()->back()->with('note-message', 'Avalability successfully added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Availability::find($id);
        return response()->json(
            [
                'view' => view('admin.models.availability-edit', compact('data'))->render(),
                'target' => '#edit-availability-form'
            ]);
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
            'starts_at' => 'required',
            'ends_at' => 'required',
        ]);

        $data = Availability::find($id);
        $data->type = $request->type;
        $data->starts_at = Carbon::parse($request->starts_at);
        $data->ends_at = Carbon::parse($request->ends_at);
        $data->save();
        return redirect()->back()->withMessage('Availability successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Availability::destroy($id);
        Session::flash('note-message', 'Availability successfully deleted!');
        return json_encode([
            'message' => 'Availability successfully deleted!'
        ]);
    }
}
