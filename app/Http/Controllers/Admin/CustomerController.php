<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Session;
use App\Models\Note;
use App\Models\Country;
use App\Library\DTables;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class CustomerController extends Controller
{
   public function index(Request $request) {
      $data = Customer::with('country');

      //filter
      if($request->has('filter_name_customers')) Session::put('filter_name_customers', $request->filter_name_customers);
      if($request->has('filter_country_customers')) Session::put('filter_country_customers', $request->filter_country_customers);

      if(Session::has('filter_name_customers')) 
          $data = $data->where('name', 'like', '%'.Session::get('filter_name_customers').'%');
      if(Session::has('filter_country_customers')) 
          $data = $data->where('country_id', Session::get('filter_country_customers'));

      $data = $data->get();

      //end filter
      $countries = Country::orderBy('name')->get();
       return view('admin.customers.index', compact('data','countries'));
   }

   public function show($id) {
       $countries = Country::orderBy('name')->get();
       $data = Customer::find($id);
       $notes = Note::where('owner_id', $id)
                   ->where('owner', 3)
                   ->orderBy('created_at', 'desc')
                   ->get();
       return view('admin.customers.show', compact('notes','data','countries'));
   }

   public function create() {
       $countries = Country::orderBy('name')->get();
       return view('admin.customers.create', compact('countries'));
   }

   public function store(Request $request) {
       $this->validate($request, [
           'name' => 'required',
           'address_line_1' => 'required',
           'share' => 'required|int',
           'status' => 'required',
           'city' => 'required',
           'province' => 'required',
           'zip' => 'required',
           'country_id' => 'required',
           'phone' => 'required',
           'email' => 'required|email|unique:customers',
           'password' => 'required',
           'website' => 'required',
           'contact_name' => 'required',
           'contact_email' => 'required|email',
           'mobile' => 'required',
           'legal_name' => 'required',
           // 'tax_number' => 'required',
       ]);

       $data = $request->all();

       //data modifications
       unset($data['_token']);
       $data['password'] = bcrypt($data['password']);
       $data['admin_id'] = Auth::guard('admin')->user()->id;
       $data['updated_by_admin_id'] = Auth::guard('admin')->user()->id;
       $data['uuid'] = $this->generate_uuid();
       $data['search_name'] = $data['name'].' ('.$data['legal_name'].')';
       $Customer = Customer::create($data);
       return redirect()->route('customers.index')->with('message', 'Customer successfully added!');
       
   }

   public function edit($id) {
       $countries = Country::orderBy('name')->get();
       $data = Customer::find($id);
       return view('admin.customers.edit', compact('data','countries'));
   }

   public function update(Request $request, $id) {
       $this->validate($request, [
           'name' => 'required',
           'address_line_1' => 'required',
           'share' => 'required|int',
           'status' => 'required',
           'city' => 'required',
           'province' => 'required',
           'zip' => 'required',
           'country_id' => 'required',
           'phone' => 'required',
           'email' => 'required|email',
           // 'password' => 'required',
           'website' => 'required',
           'contact_name' => 'required',
           'contact_email' => 'required|email',
           'mobile' => 'required',
           'legal_name' => 'required',
           // 'tax_number' => 'required',
       ]);

       $Customer = Customer::find($id);

       $data = $request->all();
       //modif data
       unset($data['_token']);
       $data['search_name'] = $data['name'].' ('.$data['legal_name'].')';
       $data['updated_by_admin_id'] = Auth::guard('admin')->user()->id;
       if($request->password == null) {
           unset($data['password']);
       } else {
           $data['password'] = bcrypt($data['password']);
       }

       $Customer->update($data);

       return redirect()->route('customers.show', $Customer->id)->with('message', 'Customer successfully updated!');
   }

   public function destroy($id) {
       Customer::destroy($id);
       Session::flash('message', 'Customer successfully deleted!');
       return json_encode([
           'redirect' => route('customers.index')
       ]);
   }

   public function listings(Request $request)
   {
       $columns = [
           'name',
           'contact_name',
           'last_booking',
           'last_login',
           'actions',
       ]; 

       if($request->has('filter_name_customers')) Session::put('filter_name_customers', $request->filter_name_customers);
       if($request->has('filter_country_customers')) Session::put('filter_country_customers', $request->filter_country_customers);

       $where = [];

       if(Session::has('filter_name_customers')) $where['name'] =  ["like", Session::get('filter_name_customers')];
       if(Session::has('filter_country_customers')) $where['country_id'] =  ["=", Session::get('filter_country_customers')];

       return response()->json(
           DTables::make( 'App\Models\Customer', [ 
               'where' => $where,
               'columnSearch' => [],
               'customSearch' => [],
               'order' => ['sortBy' => 'asc', 'orderByFieldName' => 'name'],
               'with' => [], // 'relationship1', 'realtionship2'
               'withSearch' => []//'relationship1' => ['type', 'fieldname']
           ], $columns ) 
       )->header( 'Content-type', 'application/json');
   }

   public function clearFilterSession() {
       Session::forget('filter_name_customers');
       Session::forget('filter_country_customers');
       return redirect()->route('customers.index');
   }

   public function autoCompleteAjax(Request $request) {
       $search =  $request->term;
               
       $data = Customer::where('search_name','LIKE',"%{$search}%")
                      ->orderBy('search_name', 'ASC')->limit(5)->get();
      $row_set = [];
       if(!$data->isEmpty())
       {
           foreach($data as $d)
           {
               
               $new_row['search_name']= $d->search_name;
               $new_row['id']= $d->id;
               $row_set[] = $new_row;
            }
       }
       
       return json_encode($row_set);
   }

   private function generate_uuid()
    {
        $uuid = strtolower(str_random(8));
        if( Customer::where('uuid', $uuid)->first() ) {
            return $this->generate_uuid();
        }
        return $uuid;
    }
}
