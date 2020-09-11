<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\TransactionType;
use App\Http\Controllers\Controller;
class TransactionTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = TransactionType::orderBy('name')->get();
        return view('admin.transaction_types.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.transaction_types.create');
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
        ]); 

        $type = $request->has('type') ? 1:2;

        $data = TransactionType::create([
            'name' => $request->name,
            'type' => $type,
        ]);

        return redirect()->route('transaction_types.index')->withMessage('Transaction type successfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = TransactionType::find($id);

        return view('admin.transaction_types.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = TransactionType::find($id);
        return view('admin.transaction_types.edit', compact('data'));
    }

    /**s
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
        ]); 

        $type = $request->has('type') ? 1:2;

        $data = TransactionType::find($id);
        $data->name = $request->name;
        $data->type = $type;
        $data->save();

        return redirect()->route('transaction_types.index')->withMessage('Transaction type successfully edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        TransactionType::destroy($id);
        Session::flash('message', 'Agency successfully deleted!');
        return json_encode([
            'redirect' => route('transaction_types.index')
        ]);
    }
}
