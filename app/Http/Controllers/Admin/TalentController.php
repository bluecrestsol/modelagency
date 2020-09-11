<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Auth;
use Storage;
use Image;
use Session;
use Carbon\Carbon;
use App\Models\File;
use App\Models\Hair;
use App\Models\Eyes;
use App\Models\Note;
use App\Models\Model;
use App\Models\Skill;
use App\Models\Agency;
use App\Models\Enquiry;
use App\Models\Country;
use App\Models\FileType;
use App\Library\DTables;
use App\Models\Ethnicity;
use App\Models\Experience;
use App\Models\ModelsImage;
use App\Models\ModelsClip;
use App\Models\Availability;
use App\Models\LanguageModel;
use App\Models\ExperienceModel;
use App\Models\ModelSkill;
use App\Http\Controllers\Controller;

class TalentController extends Controller
{
    public function __construct() {
        // $this->middleware('auth:admin');
    }
    public function index(Request $request) {
        $data = Model::with('country', 'images')->where('type', 2);
        //filter
        /*
        Name | Sex | Ethnicity | Age From | Age To | Status
        Height From | Height To | Body | Hair | Eyes
        */

        //filter to session
        if($request->has('filter_name_talents')) Session::put('filter_name_talents', $request->filter_name_talents);
        if($request->has('filter_sex_talents')) Session::put('filter_sex_talents', $request->filter_sex_talents);
        if($request->has('filter_ethnicity_talents')) Session::put('filter_ethnicity_talents', $request->filter_ethnicity_talents);
        if($request->has('filter_age_from_talents')) Session::put('filter_age_from_talents', $request->filter_age_from_talents);
        if($request->has('filter_age_to_talents')) Session::put('filter_age_to_talents', $request->filter_age_to_talents);
        if($request->has('filter_status_talents')) Session::put('filter_status_talents', $request->filter_status_talents);
        if($request->has('filter_height_from_talents')) Session::put('filter_height_from_talents', $request->filter_height_from_talents);
        if($request->has('filter_height_to_talents')) Session::put('filter_height_to_talents', $request->filter_height_to_talents);
        if($request->has('filter_body_talents')) Session::put('filter_body_talents', $request->filter_body_talents);
        if($request->has('filter_hair_talents')) Session::put('filter_hair_talents', $request->filter_hair_talents);
        if($request->has('filter_eyes_talents')) Session::put('filter_eyes_talents', $request->filter_eyes_talents);

        //session to query
        if(Session::has('filter_name_talents')) {
            $data = $data->where('first_name','like', '%'.Session::get('filter_name_talents').'%')
                        ->orWhere('last_name', 'like', '%'.Session::get('filter_name_talents').'%')
                        ->orWhere('public_name', 'like', '%'.Session::get('filter_name_talents').'%');
        }

        if(Session::has('filter_sex_talents')) $data = $data->where('sex', Session::get('filter_sex_talents'));
        if(Session::has('filter_ethnicity_talents')) $data = $data->where('ethnicity', Session::get('filter_ethnicity_talents'));
        if(Session::has('filter_age_from_talents')) $data = $data->where('age_look_from', Session::get('filter_age_from_talents'));
        if(Session::has('filter_age_to_talents')) $data = $data->where('age_look_to', Session::get('filter_age_to_talents'));
        if(Session::has('filter_status_talents')) $data = $data->where('status', Session::get('filter_status_talents'));
        if(Session::has('filter_height_from_talents')) $data = $data->where('height','>=', Session::get('filter_height_from_talents'));
        if(Session::has('filter_height_to_talents')) $data = $data->where('height','<=', Session::get('filter_height_to_talents'));
        if(Session::has('filter_body_talents')) $data = $data->where('body', Session::get('filter_body_talents'));
        if(Session::has('filter_hair_talents')) $data = $data->where('hair', Session::get('filter_hair_talents'));
        if(Session::has('filter_eyes_talents')) $data = $data->where('eyes', Session::get('filter_eyes_talents'));

        $data = $data->get();
        //end filter

        return view('admin.talents.index', compact('data'));
    }

    public function clearFilterSession() {
        Session::forget('filter_name_talents');
        Session::forget('filter_sex_talents');
        Session::forget('filter_age_from_talents');
        Session::forget('filter_age_to_talents');
        Session::forget('filter_status_talents');
        Session::forget('filter_height_from_talents');
        Session::forget('filter_height_to_talents');
        Session::forget('filter_body_talents');
        Session::forget('filter_hair_talents');
        Session::forget('filter_eyes_talents');


        return redirect()->route('talents.index');
    }

    public function show($id) {
        $skills = Skill::orderBy('name', 'ASC')->get();
        $experiences = Experience::orderBy('name', 'ASC')->get();
        $ethnicities = Ethnicity::orderBy('name')->get();
        $hairs = Hair::orderBy('name')->get();
        $eyes = Eyes::orderBy('name')->get();
        $countries = Country::orderBy('name')->get();
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

        return view('admin.talents.show', compact('data','skills','experiences','countries','ethnicities','hairs','eyes', 'notes', 'availabilities'));
    }

    public function create() {
        $skills = Skill::orderBy('name', 'ASC')->get();
        $experiences = Experience::orderBy('name', 'ASC')->get();
        $ethnicities = Ethnicity::orderBy('name')->get();
        $hairs = Hair::orderBy('name')->get();
        $eyes = Eyes::orderBy('name')->get();
        $countries = Country::orderBy('name')->get();
        return view('admin.talents.create', compact('countries','skills','experiences','ethnicities','hairs','eyes'));
    }

    public function store(Request $request) {
        $this->validate($request, [
            'main_photo' => 'required|mimes:jpeg,jpg|dimensions:width=600,height=800',
            'first_name' => 'required',
            'last_name' => 'required',
            'public_name' => 'required',
            'sex' => 'required',
            'dob' => 'required',
            'password' => 'required',
            // 'location' => 'required',
            // 'agency_id' => 'required',
            'model_share' => 'required|integer|between:1,100',
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
            // 'waist' => 'required|integer',
            // 'hips' => 'required|integer',
            // 'shoes' => 'required|integer',
            // 'shoulder' => 'required|integer',
            // 'collar' => 'required|integer',
            'province_id' => 'required',
            'age_look_from' => 'integer|digits_between:1,99',
            'age_look_to' => 'integer|digits_between:1,99',
            'body' => 'required',
        ]);

        $data = $request->all();

        //data modifications
        unset($data['_token']);
        unset($data['level']);

        $data['country_id'] = $data['country'];
        $data['ethnicity_id'] = $data['ethnicity'];
        $data['hair_id'] = $data['hair'];
        $data['eyes_id'] = $data['eyes'];
        $data['type'] = 2; //talent
        unset($data['country']);
        unset($data['ethnicity']);
        unset($data['hair']);
        unset($data['eyes']);
        unset($data['main_photo']);
        $data['password'] = bcrypt($data['password']);
        $data['created_by_admin_id'] = Auth::guard('admin')->user()->id;
        $data['updated_by_admin_id'] = Auth::guard('admin')->user()->id;
        $data['uuid'] = $this->generate_uuid();
        $data['search_name'] = $data['first_name'].' '.$data['last_name'].' ('.$data['public_name'].')';
        //dates
        $data['dob'] = Carbon::parse($data['dob']);
        $data['doc_expire'] = Carbon::parse($data['doc_expire']);


        if($request->has('experiences')) unset($data['experiences']);
        if($request->has('skills')) unset($data['skills']);
        if($request->has('languages')) unset($data['languages']);
        if($request->has('features')) unset($data['features']);
        unset($data['levels']);

        //store to db
        $model = Model::create($data);
        //save main photo
        Storage::putFileAs('uploads/photos',$request->file('main_photo'),$model->uuid.'_profile.jpg');


        /*//models skills and exps
        if ($request->has('experiences')) {
            $experiences = $request->experiences;
            foreach ($experiences as $i) {
                ExperienceModel::firstOrCreate([
                    'model_id' => $model->id,
                    'experience_id' => $i
                ]);
            }
        }

        if ($request->has('skills')) {
            $skills = $request->skills;
            foreach ($skills as $i) {
                ModelSkill::firstOrCreate([
                    'model_id' => $model->id,
                    'skill_id' => $i
                ]);
            }
        }*/

        if ($request->has('features')) {
            $features = $request->features;
            $model->features()->attach($features);
        }

        if ($request->has('languages')) {
            $languages = $request->languages;
            $levels = $request->levels;
            foreach ($languages as $i) {
                $level = $levels[$i];
                $model->languages()->attach([$i => ['level' => $level]]);
            }
        }

        return redirect()->route('talents.index')->with('message', 'Model successfully added!');
        
    }

    public function edit($id) {
        $skills = Skill::orderBy('name', 'ASC')->get();
        $experiences = Experience::orderBy('name', 'ASC')->get();
        $ethnicities = Ethnicity::orderBy('name')->get();
        $hairs = Hair::orderBy('name')->get();
        $eyes = Eyes::orderBy('name')->get();
        $countries = Country::orderBy('name')->get();
        $data = Model::find($id);
        return view('admin.talents.edit', compact('data','countries','skills','experiences','ethnicities','hairs','eyes'));
    }

    public function update(Request $request, $id) {
        
        $this->validate($request, [
            'main_photo' => 'mimes:jpeg,jpg|dimensions:width=600,height=800',
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
            'country' => 'required',
            'ethnicity' => 'required',
            'hair' => 'required',
            'eyes' => 'required',
            'height' => 'required|integer',
            'bust' => 'required|integer',
            // 'waist' => 'required|integer',
            // 'hips' => 'required|integer',
            // 'shoes' => 'required|integer',
            // 'shoulder' => 'required|integer',
            // 'collar' => 'required|integer',
            'province_id' => 'required',
            'age_look_from' => 'integer|digits_between:1,99',
            'age_look_to' => 'integer|digits_between:1,99',
            'body' => 'required',
        ]);

        $model = Model::find($id);

        $data = $request->all();
        //modif data
        unset($data['_token']);
        unset($data['level']);

        $data['country_id'] = $data['country'];
        $data['ethnicity_id'] = $data['ethnicity'];
        $data['hair_id'] = $data['hair'];
        $data['eyes_id'] = $data['eyes'];
        unset($data['country']);
        unset($data['ethnicity']);
        unset($data['hair']);
        unset($data['eyes']);
        unset($data['main_photo']);
        $data['search_name'] = $data['first_name'].' '.$data['last_name'].' ('.$data['public_name'].')';
        $data['dob'] = Carbon::parse($data['dob']);
        $data['updated_by_admin_id'] = Auth::guard('admin')->user()->id;

        if($request->password == null) {
            unset($data['password']);
        } else {
            $data['password'] = bcrypt($data['password']);
        }


        if($request->has('languages')) unset($data['languages']);
        if($request->has('features')) unset($data['features']);
        unset($data['levels']);
        
        $model->update($data);

        if($request->hasFile('main_photo')) {
            Storage::putFileAs('uploads/photos',$request->file('main_photo'),$model->uuid.'_profile.jpg');
        }

        /*//models skills and exps
        if ($request->has('experiences')) {
            $experiences = $request->experiences;
            foreach ($experiences as $i) {
                ExperienceModel::firstOrCreate([
                    'model_id' => $model->id,
                    'experience_id' => $i,
                ]);
            }
        }

        if ($request->has('skills')) {
            $skills = $request->skills;
            foreach ($skills as $i) {
                ModelSkill::firstOrCreate([
                    'model_id' => $model->id,
                    'skill_id' => $i
                ]);
            }
        }*/

        if ($request->has('features')) {

            $features = $request->features;
            $model->features()->attach($features);
        }

        if ($request->has('languages')) {
            $languages = $request->languages;
            $levels = $request->levels;
            foreach ($languages as $i) {
                $level = $levels[$i];
                $model->languages()->attach([$i => ['level' => $level]]);
            }
        }

        return redirect()->route('talents.show', $model->id)->with('message', 'Talent successfully updated!');
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
            'redirect' => route('talents.index')
        ]);
    }

    public function images($id) 
    {
        $data = Model::find($id);
        $images = $data->images()->orderBy('sorting')->get();
        return view('admin.models.images', compact('images','data'));
    }

    public function books($id)
    {
        $data = Model::find($id);
        $type = 1;
        $images = $data->images()->orderBy('sorting')->where('type', $type)->get();
        return view('admin.models.images', compact('images','data', 'type'));
    }

    public function snaps($id)
    {
        $data = Model::find($id);
        $type = 2;
        $images = $data->images()->orderBy('sorting')->where('type', $type)->get();
        return view('admin.models.images', compact('images','data', 'type'));
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
        $file_types = FileType::where('owner_type', 2)->get();
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
        $uuid = strtolower(str_random(8));
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


    /* PUBLIC (BECOME A TALENT) */
    public function publicCreate()
    {
        return view('admin.talents.become-a-talent1');
    }

    public function publicStore(Request $request)
    {
        //get data from request except from _token and _method
        $input = $request->except(['_token', '_method']);

        $input['uuid'] = $this->generate_uuid();
        $input['status'] = 3; //3=submission on going
        $input['type'] = 2; //2=submission on going
        $input['country_id'] = $input['country'];
        $input['ethnicity_id'] = $input['ethnicity'];
        $input['hair_id'] = $input['hair'];
        $input['eyes_id'] = $input['eyes'];
        $input['uuid'] = $this->generate_uuid();
        $input['search_name'] = $input['first_name'].' '.$input['last_name'].' ('.$input['public_name'].')';
        $input['dob'] = Carbon::parse($input['dob']);

        unset($input['country']);
        unset($input['ethnicity']);
        unset($input['hair']);
        unset($input['eyes']);

        unset($input['levels']);
        unset($input['languages']);
        unset($input['features']);
        //create model instance
        $model = Model::create($input);
        if ($request->has('features')) {
            $features = $request->features;
            $model->features()->attach($features);
        }

        if ($request->has('languages')) {
            $languages = $request->languages;
            $levels = $request->levels;
            foreach ($languages as $i) {
                $level = $levels[$i];
                $model->languages()->attach([$i => ['level' => $level]]);
            }
        }
        //return upload page with model instance
        return redirect()->route('become-a-talent.create.upload', ['uuid' => $model->uuid]);
    }

    public function publicCreateUpload($uuid)
    {
        //get model instance
        $model = Model::where('uuid', $uuid)->first();
        //return page with $model variable
        return view('admin.talents.become-a-talent2', compact('model'));
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
                    $image = ModelsImage::where('model_id', $id)->orderBy('order_id', 'DESC')->first();
                    $order_id = $image ? $image->order_id : -1;
                    $order_id++;

                    $model_image = ModelsImage::create([
                        'model_id' => $id,
                        'filename' => $filename,
                        'order_id' => $order_id,
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
                $clip = ModelsClip::where('model_id', $id)->orderBy('order_id', 'DESC')->first();
                $order_id = $clip ? $clip->order_id : -1;
                $order_id++;

                $model_clip = ModelsClip::create([
                    'model_id' => $id,
                    'filename' => $filename,
                    'order_id' => $order_id,
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
}
