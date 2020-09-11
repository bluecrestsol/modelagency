<?php

namespace App\Http\Controllers\Admin;

use Session;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{

	public function index(Request $request) {
		if (auth('admin')->user()->role != 1) return redirect()->route('admin');
		$data = Admin::orderBy('first_name', 'asc')->get();
		return view('admin.admins.index', compact('data'));
	}

	public function show($id) {
		if (auth('admin')->user()->role != 1) return redirect()->route('admin');
		$data = Admin::find($id);
		return view('admin.admins.show', compact('data'));
	}

	public function create() {
		if (auth('admin')->user()->role != 1) return redirect()->route('admin');
		return view('admin.admins.create');
	}

	public function store(Request $request) {
		$this->validate($request, [
			'first_name' => 'required',
			'last_name' => 'required',
			'mobile' => 'required',
			'role' => 'required',
			'status' => 'required',
			'email' => 'required',
			'password' => 'required|min:6',
			'title' => 'required'
		]);

		$input = $request->except(['_method', '_token']);

		$input['password'] = bcrypt($input['password']);

		$data = Admin::create($input);
		Session::flash('message', 'Admin successfully created!');
		return redirect()->route('admins.index');
	}

	public function edit($id) {
		if (auth('admin')->user()->role != 1) return redirect()->route('admin');
		$data = Admin::find($id);
		return view('admin.admins.edit', compact('data'));
	}

	public function update(Request $request, $id) {
		$rules = [
			'first_name' => 'required',
			'last_name' => 'required',
			'mobile' => 'required',
			'role' => 'required',
			'status' => 'required',
			'email' => 'required',
			'title' => 'required'
		];

		if ($request->has('password') && $request->password !== null) $rules['password'] = 'min:6';

		$this->validate($request, $rules);

		$input = $request->except(['_method', '_token']);

		$edit = Admin::find($id);

		if (isset($input['password']) && $input['password'] !== null && $input['password'] != $edit->password) {
			$input['password'] = bcrypt($input['password']);
		} else {
			unset($input['password']);
		}


		
		$edit->update($input);
		Session::flash('message', 'Admin successfully updated!');
		return redirect()->route('admins.show', $edit->id);
	}

	public function destroy($id) {
		Admin::destroy($id);
		Session::flash('message', 'Admin successfully deleted!');
		return json_encode([
		    'redirect' => route('admins.index')
		]);
	}

}
