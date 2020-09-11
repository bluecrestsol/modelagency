<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Mail;
use Auth;
use Storage;
use Session;
use Validator;
use Carbon\Carbon;
use App\Models\File;
use App\Models\Book;
use App\Models\BooksItem;
use App\Models\Hair;
use App\Models\Eyes;
use App\Models\Note;
use App\Models\Model;
use App\Models\Agency;
use App\Models\Enquiry;
use App\Models\Country;
use App\Models\Customer;
use App\Models\FileType;
use App\Models\Language;
use App\Library\DTables;
use App\Models\Ethnicity;
use App\Models\ModelsImage;
use App\Models\Availability;
use App\Models\LanguageModel;
use App\Models\CustomerModel;
use App\Http\Controllers\Controller;

class ModelController extends Controller
{
    public function __construct() {
        // $this->middleware('auth:admin');
    }
    public function index(Request $request) {
        $data = Model::with('agency', 'country', 'images', 'models_clips', 'availabilities')->where('type', 1);
        //default status active
        Session::put('filter_status_models', 1);
        //filter
        if($request->has('filter_name_models')) Session::put('filter_name_models', $request->filter_name_models);
        if($request->has('filter_agency_models')) Session::put('filter_agency_models', $request->filter_agency_models);
        if($request->has('filter_sex_models')) Session::put('filter_sex_models', $request->filter_sex_models);
        if($request->has('filter_country_models')) Session::put('filter_country_models', $request->filter_country_models);
        if($request->has('filter_status_models') and $request->filter_status_models !== null) Session::put('filter_status_models', $request->filter_status_models);

        if(Session::has('filter_name_models')) {
            $data = $data->where('first_name','like', '%'.Session::get('filter_name_models').'%')
                        ->orWhere('last_name', 'like', '%'.Session::get('filter_name_models').'%')
                        ->orWhere('public_name', 'like', '%'.Session::get('filter_name_models').'%');
        }

        if(Session::has('filter_agency_models'))
            $data = $data->where('agency_id', Session::get('filter_agency_models'));
        if(Session::has('filter_sex_models')) 
            $data = $data->where('sex', Session::get('filter_sex_models'));
        if(Session::has('filter_country_models')) 
            $data = $data->where('country_id', Session::get('filter_country_models'));
        if(Session::has('filter_status_models')) 
            $data = $data->where('status', Session::get('filter_status_models'));

        //order by availability
        $data = $data->whereHas('availabilities', function ($query) {
            $query->orderBy('created_at', 'desc');
        })->get();


        //without availability
        $without_availability = Model::with('agency', 'country', 'images', 'models_clips', 'availabilities')->doesntHave('availabilities')->where('type', 1);
        if(Session::has('filter_name_models')) {
            $without_availability = $without_availability->where('first_name','like', '%'.Session::get('filter_name_models').'%')
                        ->orWhere('last_name', 'like', '%'.Session::get('filter_name_models').'%')
                        ->orWhere('public_name', 'like', '%'.Session::get('filter_name_models').'%');
        }

        if(Session::has('filter_agency_models'))
            $without_availability = $without_availability->where('agency_id', Session::get('filter_agency_models'));
        if(Session::has('filter_sex_models')) 
            $without_availability = $without_availability->where('sex', Session::get('filter_sex_models'));
        if(Session::has('filter_country_models')) 
            $without_availability = $without_availability->where('country_id', Session::get('filter_country_models'));
        if(Session::has('filter_status_models')) 
            $without_availability = $without_availability->where('status', Session::get('filter_status_models'));
        //end filter
        
        $data = $data->merge($without_availability->get());

        $countries = Country::orderBy('name')->get();
        $agencies = Agency::orderBy('name')->get();
        return view('admin.models.index', compact('data','countries','agencies'));
    }

    public function show($id) {
        $agencies = Agency::orderBy('name')->get();
        $ethnicities = Ethnicity::orderBy('name')->get();
        $hairs = Hair::orderBy('name')->get();
        $eyes = Eyes::orderBy('name')->get();
        $countries = Country::orderBy('name')->get();
        $languages = Language::orderByRaw('FIELD(id,2,1) DESC')->orderBy('name', 'ASC')->get();
        $data = Model::find($id);

        //notes
        $notes = Note::where('owner_id', $id)
                    ->where('owner', 2)
                    ->orderBy('created_at', 'desc')
                    ->get();
        //avalabilities
        $availabilities = Availability::where('model_id', $id)
                    ->orderBy('starts_at', 'desc')
                    ->get();

        return view('admin.models.show', compact('data','countries','agencies','ethnicities','hairs','eyes', 'notes', 'availabilities', 'languages'));
    }

    public function create() {
        $agencies = Agency::orderBy('name')->get();
        $ethnicities = Ethnicity::orderBy('name')->get();
        $hairs = Hair::orderBy('name')->get();
        $eyes = Eyes::orderBy('name')->get();
        $countries = Country::orderBy('name')->get();
        $languages = Language::orderByRaw('FIELD(id,2,1) DESC')->orderBy('name', 'ASC')->get();
        return view('admin.models.create', compact('countries','agencies','ethnicities','hairs','eyes', 'languages'));
    }

    public function store(Request $request) {
        $this->validate($request, [
            'main_photo' => 'required|mimes:jpeg,jpg|dimensions:max_width=600,max_height=800',
            'profile_body_photo' => 'required|mimes:jpeg,jpg|dimensions:max_width=600,max_height=800',
            'comp_card' => 'mimes:jpeg,jpg',
            'first_name' => 'required',
            'last_name' => 'required',
            'public_name' => 'required',
            'sex' => 'required',
            'dob' => 'required',
            'password' => 'required',
            'model_share' => 'required|integer|between:1,100',
            'doc_type' => 'required',
            'doc_number' => 'required',
            'doc_expire' => 'required',
            'email' => 'required|email|unique:models',
            'mobile' => 'required',
            'country_id' => 'required',
            'ethnicity_id' => 'required',
            'hair_id' => 'required',
            'eyes_id' => 'required',
            'height' => 'required|integer',
            'bust' => 'required|integer',
            'waist' => 'required|integer',
            'hips' => 'required|integer',
            'shoes' => 'required|integer',
            'province_id' => 'required',
        ], [
            'ethnicity_id.required' => 'Ethnicity is required'
        ]);

        $data = $request->all();

        //data modifications
        unset($data['_token']);
        unset($data['level']);

        $data['type'] = 1; //model
        unset($data['main_photo']);
        unset($data['comp_card']);
        unset($data['profile_body_photo']);
        $data['password'] = bcrypt($data['password']);
        $data['created_by_admin_id'] = Auth::guard('admin')->user()->id;
        $data['updated_by_admin_id'] = Auth::guard('admin')->user()->id;
        $data['uuid'] = $this->generate_uuid();
        $data['search_name'] = $data['first_name'].' '.$data['last_name'].' ('.$data['public_name'].')';

        $data['exclusive'] = $request->has('exclusive') ? 1:0;
        //dates
        $data['dob'] = Carbon::createFromFormat('m/d/Y', $data['dob'])->toDateString();

        $data['doc_expire'] = Carbon::createFromFormat('m/d/Y', $data['doc_expire'])->toDateTimeString();


        if($request->has('languages')) unset($data['languages']);
        unset($data['levels']);

        if($request->hasFile('comp_card')) {
            
            $file = $request->file('comp_card');
            $filename = md5($file->getClientOriginalName().time()) . '.jpeg';
            
            $data['comp_card'] = $filename;
            
            Storage::putFileAs('uploads/photos/comp_cards',$request->file('comp_card'),$filename);
        }

        //store to db
        $model = Model::create($data);

        if ($request->has('languages')) {
            $languages = $request->languages;
            $levels = $request->levels;
            foreach ($languages as $i) {
                $level = $levels[$i];
                $model->languages()->attach([$i => ['level' => $level]]);
            }
        }

        //save main photo
        Storage::putFileAs('uploads/photos',$request->file('main_photo'),$model->uuid.'_profile.jpg');
        //save profile body photo
        Storage::putFileAs('uploads/photos',$request->file('profile_body_photo'),$model->uuid.'_profile_body.jpg');
        

        return redirect()->route('models.index')->with('message', 'Model successfully added!');
        
    }

    public function edit($id) {
        $agencies = Agency::orderBy('name')->get();
        $ethnicities = Ethnicity::orderBy('name')->get();
        $hairs = Hair::orderBy('name')->get();
        $eyes = Eyes::orderBy('name')->get();
        $countries = Country::orderBy('name')->get();
        $data = Model::find($id);
        $languages = Language::orderByRaw('FIELD(id,2,1) DESC')->orderBy('name', 'ASC')->get();
        return view('admin.models.edit', compact('data','countries','agencies','ethnicities','hairs','eyes', 'languages'));
    }

    public function update(Request $request, $id) {
        $this->validate($request, [
            'main_photo' => 'mimes:jpeg,jpg|dimensions:max_width=600,max_height=800',
            'profile_body_photo' => 'mimes:jpeg,jpg|dimensions:max_width=600,max_height=800',
            'comp_card' => 'mimes:jpeg,jpg',
            'first_name' => 'required',
            'last_name' => 'required',
            'public_name' => 'required',
            'sex' => 'required',
            'dob' => 'required',
            // 'password' => 'required',
            // 'location' => 'required',
            // 'agency_id' => 'required',
            'model_share' => 'required|integer|between:1,100',
            'doc_type' => 'required',
            'doc_number' => 'required',
            'doc_expire' => 'required',
            'email' => 'required|email',
            'mobile' => 'required',
            'country_id' => 'required',
            'ethnicity_id' => 'required',
            'hair_id' => 'required',
            'eyes_id' => 'required',
            'height' => 'required|integer',
            'bust' => 'required|integer',
            'waist' => 'required|integer',
            'hips' => 'required|integer',
            'shoes' => 'required|integer',
            'province_id' => 'required',
            // 'shoulder' => 'required|integer',
            // 'collar' => 'required|integer',
        ]);

        $model = Model::find($id);

        $data = $request->all();
        //modif data
        unset($data['_token']);
        unset($data['level']);

        // $data['agency_id'] = $data['agency'];
        // $data['country_id'] = $data['country'];
        // $data['ethnicity_id'] = $data['ethnicity'];
        // $data['hair_id'] = $data['hair'];
        // $data['eyes_id'] = $data['eyes'];
        // unset($data['agency']);
        // unset($data['country']);
        // unset($data['ethnicity']);
        // unset($data['hair']);
        // unset($data['eyes']);
        unset($data['main_photo']);
        unset($data['comp_card']);
        unset($data['profile_body_photo']);
        $data['search_name'] = $data['first_name'].' '.$data['last_name'].' ('.$data['public_name'].')';
        $data['dob'] = Carbon::parse($data['dob']);
        $data['updated_by_admin_id'] = Auth::guard('admin')->user()->id;

        $data['exclusive'] = $request->has('exclusive') ? 1:0;

        if($request->password == null || $request->password == $model->password) {
            unset($data['password']);
        } else {
            $data['password'] = bcrypt($data['password']);
        }

        

        if($request->has('languages')) unset($data['languages']);
        unset($data['levels']);

        if($request->hasFile('comp_card')) {
            if ($model->comp_card) {
                Storage::delete("uploads/photos/comp_cards/{$model->comp_card}");    
            }
            $file = $request->file('comp_card');
            $filename = md5($file->getClientOriginalName().time()) . '.jpeg';
            
            $data['comp_card'] = $filename;
            
            Storage::putFileAs('uploads/photos/comp_cards',$request->file('comp_card'),$filename);
        }

        if($request->hasFile('main_photo')) {

            if (Storage::exists("uploads/photos/{$model->uuid}_profile.jpg")) {
                Storage::delete("uploads/photos/{$model->uuid}_profile.jpg");
            }
            Storage::putFileAs('uploads/photos',$request->file('main_photo'), $model->uuid.'_profile.jpg');
        }

        if($request->hasFile('profile_body_photo')) {

            if (Storage::exists("uploads/photos/{$model->uuid}_profile_body.jpg")) {
                Storage::delete("uploads/photos/{$model->uuid}_profile_body.jpg");
            }
            Storage::putFileAs('uploads/photos',$request->file('profile_body_photo'), $model->uuid.'_profile_body.jpg');
        }

        //store to db
        $model->update($data);

        if ($request->has('languages')) {
            $languages = $request->languages;
            $levels = $request->levels;
            foreach ($languages as $i) {
                $level = $levels[$i];
                $model->languages()->attach([$i => ['level' => $level]]);
            }
        }

        


        return redirect()->route('models.show', $model->id)->with('message', 'Model successfully updated!');
    }

    public function destroy($id) {
        $model = Model::find($id);
        $uuid = $model->uuid;
        Model::destroy($id);
        /*
            availabilities
            enquiries
            models_photos (including files)
            notes
        */

        Availability::where('model_id', $id)->delete();
        Enquiry::where('model_id', $id)->delete();
        Note::where('owner', 2)->where('owner_id', $id)->delete();
        $models_images = ModelsImage::where('model_id', $id)->get();
        foreach ($models_images as $i) {
            Storage::delete("uploads/photos/{$i->filename}");
        }
        ModelsImage::where('model_id', $id)->delete();
        


        Session::flash('message', 'Model successfully deleted!');
        return json_encode([
            'redirect' => route('models.index')
        ]);
    }

    public function listings(Request $request)
    {
        $columns = [
            'name',
            'public_name',
            'agency_name',
            'last_booking',
            'last_login',
            'actions',
        ];

        if($request->has('filter_name_models')) Session::put('filter_name_models', $request->filter_name_models);
        if($request->has('filter_agency_models')) Session::put('filter_agency_models', $request->filter_agency_models);
        if($request->has('filter_country_models')) Session::put('filter_country_models', $request->filter_country_models);

        $where = [];

        if(Session::has('filter_name_models')) {
        	$where['first_name'] = ["like", Session::get('filter_name_models')];	
        	$where['last_name'] = ["orLike", Session::get('filter_name_models')];
        	$where['public_name'] = ["orLike", Session::get('filter_name_models')];
        }
        if(Session::has('filter_agency_models')) $where['agency_id'] = ["=", Session::get('filter_agency_models')];
        if(Session::has('filter_country_models')) $where['country_id'] = ["=", Session::get('filter_country_models')];

        return response()->json(
            DTables::make( 'App\Models\Model', [ 
                'where' => $where,
                'columnSearch' => [],
                'customSearch' => [],
                'order' => ['sortBy' => 'asc', 'orderByFieldName' => 'id'],
                'with' => ['agency','images'], // 'relationship1', 'realtionship2'
                'withSearch' => []//'relationship1' => ['type', 'fieldname']
            ], $columns ) 
        )->header( 'Content-type', 'application/json');
    }

    public function clearFilterSession() {
        Session::forget('filter_name_models');
        Session::forget('filter_agency_models');
        Session::forget('filter_sex_models');
        Session::forget('filter_country_models');
        return redirect()->route('models.index');
    }

    public function images($id) 
    {
        $data = Model::find($id);
        $images = $data->images()->orderBy('sorting')->get();
        return view('admin.models.images', compact('images','data'));
    }

    public function book_photos($id)
    {
        $data = Model::find($id);
        $type = 1;
        $images = $data->images()->orderBy('sorting')->where('type', $type)->get();
        return view('admin.models.images', compact('images','data', 'type'));
    }

    public function snap_photos($id)
    {
        $data = Model::find($id);
        $type = 2;
        $images = $data->images()->orderBy('sorting')->where('type', $type)->get();
        return view('admin.models.images', compact('images','data', 'type'));
    }

    public function books($id)
    {
        $data = Model::with('books')->with('books.items')->find($id);
        return view('admin.books.index', compact('data'));
    }

    public function files($id)
    {
        $data = Model::find($id);
        $title = "FILES FOR MODEL {$data->full_name} ({$data->public_name})";
        return view('admin.files.index', compact('data', 'title'));
    }

    public function filesCreate($id)
    {
        $owner_id = $id;
        $file_types = FileType::where('owner_type', 2)->orderBy('name')->get();
        return view('admin.files.form', compact('owner_id', 'file_types')); 
    }

    public function filesStore(Request $request, $id)
    {
        $this->validate($request, [
                'file_type_id' => 'required',
                'name' => 'required',
                'file' => 'required'
            ]);

        $file = $request->file('file');
        $md5 = md5(time().$file->getClientOriginalName());
        $extension = $file->getClientOriginalExtension();

        $model = Model::find($id);

        Storage::putFileAs('uploads/files', $request->file('file'), $md5);
        $models_file = File::create([
                'file_type_id' => $request->file_type_id,
                'owner_id' => $id,
                'md5' => $md5,
                'extension' => $extension,
                'name' => $request->name,
            ]);

        $model->files = intval($model->files) + 1;
        $model->save();

        return redirect()->route('models.files.index', compact('id'));
    }

    private function generate_uuid()
    {
        // $uuid = strtolower(str_random(8));
        $uuid = mt_rand(10000000, 99999999);
        if( Model::where('uuid', $uuid)->first() ) {
            return $this->generate_uuid();
        }
        return $uuid;
    }

    public function autoCompleteAjax(Request $request) 
    {
        $search =  $request->term;
                
        $data = Model::where('search_name','LIKE',"%{$search}%")
                       ->orderBy('search_name', 'ASC')->limit(5)->get();
        $row_set = [];
        if(!$data->isEmpty())
        {
            foreach($data as $d)
            {
                
                $new_row['search_name']= $d->search_name;
                $new_row['image']= $d->profile_photo;
                $new_row['id']= $d->id;
                $row_set[] = $new_row; //build an array
            }
        }
        
        return json_encode($row_set); 
    }

    public function updateProfilePhoto(Request $request, $id) 
    {
        $model = Model::find($id);
        $directory = 'uploads/photos';
        if($request->hasFile('main_image')) {
            Storage::putFileAs($directory,$request->file('main_image'),$model->uuid.'_profile.jpg');
        }

        return json_encode(['message' => 'Image successfully updated', 'src' => $model->profile_photo]);
    }

    public function downloadCompanyCard($id)
    {
        $model = Model::find($id);
        $path = public_path("storage/uploads/photos/comp_cards/{$model->comp_card}");
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        $filename = strtoupper($model->public_name) . " - Morgan & Preston Models Bangkok.{$ext}";
        return response()->download(public_path("storage/uploads/photos/comp_cards/{$model->comp_card}"), $filename);
    }

    public function deleteCompanyCard($id)
    {
        $model = Model::find($id);
        if ($model->comp_card) {
            Storage::delete("uploads/photos/comp_cards/$model->comp_card");
            $model->comp_card = null;
        }

        $model->save();

        return response()->json(['success' => 1, 'message' => 'Successfully removed']);
    }

    public function clips($id) 
    {
        $data = Model::with('models_clips')->find($id);
        $clips = $data->models_clips;
        return view('admin.models.clips', compact('clips','data'));
    }

    public function showPromotePage($uuid)
    {
        $data = Model::where('uuid', $uuid)->first();
        return view('admin.models.promote', compact('data'));
    }

    public function promote(Request $request)
    {
        
        //store promoted_at  on models table
        $model = Model::where('uuid', $request->model_uuid)->first();
        $model->promoted_at = Carbon::now();
    
        $email_data = [
            'public_name' => $model->public_name,
            'eyes' => $model->eyes->name,
            'hair' => $model->hair->name,
            'shoes' => $model->shoes,
            'images' => $request->images
        ];

        $customers = Customer::all();

        foreach ($customers as $c) {

            $email_data['customer_uuid'] = $c->uuid;
            $email_data['model_uuid'] = $model->uuid;

            Mail::send('admin.emails.promote', ['data' => $email_data], function ($m) use ($model, $c) {
                $m->from('promotion@mpmodelsbkk.com', 'Morgan & Preston Models');
                $gender = config('constants.models.sex'.$model->sex);
                $m->to($c->contact_email, '')->subject("New {$gender} model in town: {$model->public_name}");
            });

        }
        
        $model->save();

        return redirect()->route('models.index')->with('message', 'Model promotion successfully sent!');

        //send an html email to all customers (the contact_email), with subject: New {male/female/transgender} model in town: {MODEL PUBLIC NAME}
        /* On html body:
        NAME: {MODEL PUBLICK NAME}
        LIKE | DISLIKE links
        */

        /* 
        Then we show all the details that we have on the comp card (download one and show the same fields from db)
        so ethinicty, height etc

        Then we embed the 5 selected images
        * very important: the links like|dislike must be in this format:
        like: domain.com/pr/model/{model_uuid}/{customer_uuid}/like
        dislike: domain.com/pr/model/{model_uuid}/{customer_uuid}/dislike
        */
    }

    public function promotionResponse($model_uuid, $customer_uuid, $response)
    {
        //validate if customer and model exists
        $model = Model::where('uuid', $model_uuid)->first();
        $customer = Customer::where('uuid', $customer_uuid)->first();
        
        //we must create an entry on table customer_model first or creates
        if ($model && $customer) {

            $vote = 0;
            if ($response == 'like') {
                $vote = 1;
            } elseif ($response == 'dislike') {
                $vote = 2;
            }

            $customer_model = CustomerModel::firstOrNew([
                'model_id' => $model->id,
                'customer_id' => $customer->id,
            ]);

            $customer_model->vote = $vote;

            $customer_model->save();

            return redirect('/');
        } 

        return redirect('/');
    }

    /* PUBLIC (BECOME A Model) */
    public function publicCreate()
    {
        return view('admin.models.become-a-model1');
    }

    public function publicStore(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'public_name' => 'required',
            'sex' => 'required',
            'dob' => 'required',
            'password' => 'required',
            // 'location' => 'required',
            // 'agency_id' => 'required',
            // 'model_share' => 'required|integer|between:1,100',//revenue
            'doc_type' => 'required',
            'doc_number' => 'required',
            'doc_expire' => 'required',
            'email' => 'required|email|unique:models',
            'mobile' => 'required',
            'country' => 'required',
            'ethnicity' => 'required',
            'hair' => 'required',
            'eyes' => 'required',
            'height' => 'required|integer',
            'bust' => 'required|integer',
            'waist' => 'required|integer',
            'hips' => 'required|integer',
            'shoes' => 'required|integer',
            'province_id' => 'required',
            // 'shoulder' => 'required|integer',
            // 'collar' => 'required|integer',
        ]);

        $data = $request->all();

        //data modifications
        unset($data['_token']);
        unset($data['level']);

        // $data['agency_id'] = $data['agency'];
        $data['country_id'] = $data['country'];
        $data['ethnicity_id'] = $data['ethnicity'];
        $data['hair_id'] = $data['hair'];
        $data['eyes_id'] = $data['eyes'];
        $data['type'] = 1; //model
        // unset($data['agency']);
        unset($data['country']);
        unset($data['ethnicity']);
        unset($data['hair']);
        unset($data['eyes']);
        
        
        
        $data['password'] = bcrypt($data['password']);
        // $data['created_by_admin_id'] = Auth::guard('admin')->user()->id;
        // $data['updated_by_admin_id'] = Auth::guard('admin')->user()->id;
        $data['uuid'] = $this->generate_uuid();
        $data['search_name'] = $data['first_name'].' '.$data['last_name'].' ('.$data['public_name'].')';

        $data['exclusive'] = $request->has('exclusive') ? 1:0;
        //dates
        $data['dob'] = Carbon::parse($data['dob']);
        $data['doc_expire'] = Carbon::parse($data['doc_expire']);

        if($request->has('languages')) unset($data['languages']);
        unset($data['levels']);

        //store to db
        $model = Model::create($data);

        if ($request->has('languages')) {
            $languages = $request->languages;
            $levels = $request->levels;
            foreach ($languages as $i) {
                $level = $levels[$i];
                $model->languages()->attach([$i => ['level' => $level]]);
            }
        }

        //return upload page with model instance
        return redirect()->route('become-a-model.create.upload', ['uuid' => $model->uuid]);
    }

    public function publicCreateUpload($uuid)
    {
        //get model instance
        $model = Model::where('uuid', $uuid)->first();
        //return page with $model variable
        return view('admin.models.become-a-model2', compact('model'));
    }

    public function publicStoreUpload(Request $request, $uuid)
    {
        $model = Model::where('uuid', $uuid)->first();
        $id = $model->id;


        //check if request is for ids/files | images | clips | about me input
        if ($request->hasFile('files')) {

            $file = $request->file('files');

            $md5 = md5(time().$file->getClientOriginalName());
            $extension = $file->getClientOriginalExtension();

            Storage::putFileAs('uploads/files', $request->file('files'), $md5);
            $models_file = File::create([
                    'file_type_id' => 4, //passport - temporary because no license or id file type created yet
                    'owner_id' => $model->id,
                    'md5' => $md5,
                    'extension' => $extension,
                    'name' => $file->getClientOriginalName(), //temporary - no specifications
                ]);

            $model->files = (intval($model->files) + 1);
            $model->save();

            return response()->json(['success' => 1, 'message' => 'Upload successful!']);

        } elseif ($request->hasFile('images')) {

                $this->validate($request, [
                    'images' => 'mimes:jpeg,jpg'
                ]);

                //validate
                    $file = $request->file("images");
                    list($width, $height) = getimagesize($file);
                    
                    $filename = md5(time().$file->getClientOriginalName()).'.jpg';
                    $image = ModelsImage::where('model_id', $id)->orderBy('sorting', 'DESC')->first();
                    $sorting = $image ? $image->sorting : -1;
                    $sorting++;

                    $model_image = ModelsImage::create([
                        'model_id' => $id,
                        'filename' => $filename,
                        'sorting' => $sorting,
                    ]);

                    //update models photos
                    $photos = ModelsImage::where('model_id', $id)->count();
                    $model->photos = $photos;
                    $model->save();

                    //laravel intervention image plugin
                    $img = Image::make($file);
                    //resize image to 600 long size
                    if ($width > $height) {
                        // resize the image to a width of 600 and constrain aspect ratio (auto height)
                        $img = $img->resize(600, null, function ($constraint) {
                            $constraint->aspectRatio();
                        });
                    } else {
                        // resize the image to a height of 600 and constrain aspect ratio (auto width)
                        $img = $img->resize(null, 600, function ($constraint) {
                            $constraint->aspectRatio();
                        });
                    }

                    $img = $img->encode('jpg');

                    Storage::put('uploads/photos/'.$filename, $img->__toString());
                

                return response()->json(["success" => 1, "message" => "Image Stored"]);

        } elseif ($request->hasFile('clips')) {

            $this->validate($request, [
                'clips' => 'mimetypes:video/avi,video/mpeg,video/quicktime,video/mp4'
            ]);

            //validate

                $file = $request->file("clips");
                list($width, $height) = getimagesize($file); //not used on clips
                
                $filename = md5(time().$file->getClientOriginalName()).'.'.$file->getClientOriginalExtension();
                $clip = ModelsClip::where('model_id', $id)->orderBy('sorting', 'DESC')->first();
                $sorting = $clip ? $clip->sorting : -1;
                $sorting++;

                $model_clip = ModelsClip::create([
                    'model_id' => $id,
                    'filename' => $filename,
                    'sorting' => $sorting,
                ]);

                Storage::disk('public')->putFileAs('uploads/clips/models', $file, $filename);
            

            return response()->json(["success" => 1, "message" => "Clip Stored"]);

        } else if ($request->has('about')) {
            
            $model->about = $request->about;
            $model->status = 4; //4=submitted
            $model->save();

            return redirect('/');

        }
    }


    public function changeUuid()
    {
        $models = Model::all();

        foreach ($models as $model) {
            $old_uuid = $model->uuid;
            $model->uuid = $this->generate_uuid();
            $model->save();

            $old_dir = "uploads/photos/{$old_uuid}_profile.jpg";
            $new_dir = "uploads/photos/{$model->uuid}_profile.jpg";
            if (Storage::disk('public')->exists($old_dir)) Storage::disk('public')->copy($old_dir, $new_dir);
            
            $old_dir = "uploads/photos/{$old_uuid}_profile_body.jpg";
            $new_dir = "uploads/photos/{$model->uuid}_profile_body.jpg";
            if (Storage::disk('public')->exists($old_dir)) Storage::disk('public')->copy($old_dir, $new_dir);
            
        }
        
        return "uuid converted!";
    }



}
