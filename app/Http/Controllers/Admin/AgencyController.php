<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Auth;
use Session;
use App\Models\Note;
use App\Models\Agency;
use App\Models\Country;
use App\Library\DTables;
use App\Http\Controllers\Controller;


class AgencyController extends Controller
{
    public function index(Request $request) {
        $data = Agency::with('country');

        //filter
        if($request->has('filter_name_agencies')) Session::put('filter_name_agencies', $request->filter_name_agencies);
        if($request->has('filter_country_agencies')) Session::put('filter_country_agencies', $request->filter_country_agencies);

        if(Session::has('filter_name_agencies')) 
            $data = $data->where('name', 'like', '%'.Session::get('filter_name_agencies').'%');
        if(Session::has('filter_country_agencies')) 
            $data = $data->where('country_id', Session::get('filter_country_agencies'));

        $data = $data->get();

        //end filter
        $countries = Country::orderBy('name')->get();
        
        return view('admin.agencies.index', compact('data','countries'));
    }

    public function show($id) {
        $countries = Country::orderBy('name')->get();
        $data = Agency::find($id);
        $notes = Note::where('owner_id', $id)
                    ->where('owner', 1)
                    ->orderBy('created_at', 'desc')
                    ->get();
        return view('admin.agencies.show', compact('notes','data','countries'));
    }

    public function create() {
        $countries = Country::orderBy('name')->get();
        return view('admin.agencies.create', compact('countries'));
    }

    public function store(Request $request) {
        $this->validate($request, [
            'name' => 'required',
            'password' => 'required',
            'status' => 'required',
            'share' => 'required|integer',
            'tax' => 'required',
            'address_line_1' => 'required',
            'city' => 'required',
            'province' => 'required',
            'zip' => 'required',
            'country_id' => 'required',
            'website' => 'required',
            'email' => 'required|email|unique:agencies',
            'phone' => 'required',
            'contact_person' => 'required',
            'contact_email' => 'required',
            'contact_mobile' => 'required',
            'legal_name' => 'required',
        ]);

        $data = $request->all();

        //data modifications
        unset($data['_token']);
        $data['password'] = bcrypt($data['password']);
        $data['admin_id'] = Auth::guard('admin')->user()->id;
        $data['updated_by_admin_id'] = Auth::guard('admin')->user()->id;
        $data['uuid'] = $this->generate_uuid();
        $data['search_name'] = $data['name'].' ('.$data['legal_name'].')';
        $agency = Agency::create($data);
        return redirect()->route('agencies.index')->with('message', 'Agency successfully added!');
        
    }

    public function edit($id) {
        $countries = Country::orderBy('name')->get();
        $data = Agency::find($id);
        return view('admin.agencies.edit', compact('data','countries'));
    }

    public function update(Request $request, $id) {
        $this->validate($request, [
            'name' => 'required',
            'status' => 'required',
            'share' => 'required',
            'tax' => 'required',
            'address_line_1' => 'required',
            'city' => 'required',
            'province' => 'required',
            'zip' => 'required',
            'country_id' => 'required',
            'website' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'contact_person' => 'required',
            'contact_email' => 'required',
            'contact_mobile' => 'required',
            'legal_name' => 'required',
        ]);

        $agency = Agency::find($id);

        $data = $request->all();
        //modif data
        unset($data['_token']);
        $data['search_name'] = $data['name'].' ('.$data['legal_name'].')';
        $data['updated_by_admin_id'] = Auth::guard('admin')->user()->id;
        if($request->password == null || $request->password == $agency->password) {
            unset($data['password']);
        } else {
            $data['password'] = bcrypt($data['password']);
        }

        $agency->update($data);

        return redirect()->route('agencies.show', $agency->id)->with('message', 'Agency successfully updated!');
    }

    public function destroy($id) {
        Agency::destroy($id);
        Session::flash('message', 'Agency successfully deleted!');
        return json_encode([
            'redirect' => route('agencies.index')
        ]);
    }

    public function listings(Request $request)
    {
        $columns = [
            'name',
            'country_name',
            'contact_person',
            'last_login',
            'actions',
        ]; 

        if($request->has('filter_name_agencies')) Session::put('filter_name_agencies', $request->filter_name_agencies);
        if($request->has('filter_country_agencies')) Session::put('filter_country_agencies', $request->filter_country_agencies);

        $where = [];

        if(Session::has('filter_name_agencies')) $where['name'] =  ["like", Session::get('filter_name_agencies')];
        if(Session::has('filter_country_agencies')) $where['country_id'] =  ["=", Session::get('filter_country_agencies')];

        return response()->json(
            DTables::make( 'App\Models\Agency', [ 
                'where' => $where,
                'columnSearch' => [],
                'customSearch' => [],
                'order' => ['sortBy' => 'asc', 'orderByFieldName' => 'name'],
                'with' => ['country'], // 'relationship1', 'realtionship2'
                'withSearch' => []//'relationship1' => ['type', 'fieldname']
            ], $columns ) 
        )->header( 'Content-type', 'application/json');
    }

    public function clearFilterSession() {
        Session::forget('filter_name_agencies');
        Session::forget('filter_country_agencies');
        return redirect()->route('agencies.index');
    }

    private function generate_uuid()
    {
        $uuid = strtolower(str_random(8));
        if( Agency::where('uuid', $uuid)->first() ) {
            return $this->generate_uuid();
        }
        return $uuid;
    }
}
