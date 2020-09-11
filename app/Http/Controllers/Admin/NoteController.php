<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Session;
use App\Models\Note;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class NoteController extends Controller
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
            'note' => 'required',
        ]);

        $note = Note::create([
            'created_by_admin_id' => Auth::guard('admin')->user()->id,
            'owner' => $request->owner,
            'owner_id' => $request->owner_id,
            'note' => $request->note,
        ]);

        return redirect()->back()->with('note-message', 'Note successfully added!');
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
        //
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
            'note' => 'required',
        ]);

        $note = Note::find($id);
        $note->note = $request->note;
        $note->save();

        //return redirect()->back()->with('message', 'Note successfully updated!');
        return json_encode(['note-message' => 'Note successfully updated!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Note::destroy($id);
        Session::flash('note-message', 'Note successfully deleted!');
        return json_encode([
            'message' => 'Note successfully deleted!'
        ]);
    }
}
