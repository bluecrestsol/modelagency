<?php

namespace App\Models;

use Storage;
use App\Models\LanguageModel;
use App\Models\Skill;
use App\Models\Experience;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model as ParentModel;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Model extends Authenticatable
{
	protected $appends = ['actions', 'last_login', 'last_booking', 'agency_name'];

    protected $guarded = ['id'];
    
    public function features()
    {
        return $this->belongsToMany('App\Models\Feature');
    }

    public function languages()
    {
        return $this->belongsToMany('App\Models\Language')->withPivot('level');
    }

    public function country() {
    	return $this->belongsTo('App\Models\Country');
    }

    public function province()
    {
        return $this->belongsTo('App\Models\Province');
    }

    public function ethnicity() {
    	return $this->belongsTo('App\Models\Ethnicity');
    }

    public function hair() {
    	return $this->belongsTo('App\Models\Hair');
    }

    public function eyes() {
    	return $this->belongsTo('App\Models\Eyes');
    }

    public function agency() {
	   return $this->belongsTo('App\Models\Agency');
    }

    public function notes() {
    	return $this->hasMany('App\Models\Note','owner_id');
    }

    public function availabilities() {
        $today = Carbon::today();
    	return $this->hasMany('App\Models\Availability')->where('ends_at', '>=', $today);
    }

    public function fileList()
    {
        return $this->hasMany('App\Models\File', 'owner_id')->with('file_type')->whereHas('file_type', function($query) {
            $query->where('owner_type', 2);
        });
    }

    public function getDobAttribute($value) {
        return Carbon::parse($value)->toFormattedDateString();
    }

    public function getFullNameAttribute() {
        return $this->first_name.' '.$this->last_name;
    }

    public function getDocExpireAttribute ($value) 
    {
        return Carbon::parse($value)->toDateString();
    }

    public function getLocationAttribute($value) {
        return config('constants.models.location.'.$value);
    }

    public function getAgencyNameAttribute(){
        if($this->agency_id)
            return $this->agency->name;
        return 'Freelancer';
    }

    public function getNameAttribute() {
    	return $this->first_name . ' ' . $this->last_name;
    }

    public function getLastLoginAttribute() {
        // if($this->last_logged_at && $this->last_logged_geo)
        //    return $this->last_logged_at . ' (' .$this->last_logged_geo.')';
    	return $this->last_logged_at;
    }

    public function getLastBookingAttribute() {
        return '-'; //temporary no instructions
    }

    // public function getActionsAttribute() {
    //     return '<a class="btn btn-info btn-xs" href='.route('models.show', ['id' => $this->id]).'><i class="fa fa-edit"></i> Show</a>'.
    // 	        '<a class="btn btn-info btn-xs" href='.route('models.images', ['id' => $this->id]).'><span class="badge">'.$this->photos.'</span> Images</a>';
    // }

    public function images() {
        return $this->hasMany('App\Models\ModelsImage');
    }

    public function book_photos() {
        return $this->hasMany('App\Models\ModelsImage')->where('type', 1);
    }

    public function snap_photos() {
        return $this->hasMany('App\Models\ModelsImage')->where('type', 2);
    }

    public function books()
    {
        return $this->hasMany('App\Models\Book')->orderBy('name');
    }



    public function getMainPhotoAttribute() {
        return '<img src="'.asset('storage/uploads/photos/'.$this->uuid.'_profile.jpg').'" width="100px" height="125px"/>';
    }

    public function getProfilePhotoAttribute() {
        return asset('storage/uploads/photos/'.$this->uuid.'_profile.jpg')."?".rand();
    }

    public function getProfileBodyPhotoAttribute() {
        if (Storage::exists('uploads/photos/'.$this->uuid.'_profile_body.jpg')) {
            return asset('storage/uploads/photos/'.$this->uuid.'_profile_body.jpg')."?".rand();
        } 

        return null;
    }

    public function getCompanyCardAttribute() {
        if (!$this->comp_card) return null;
        return asset('storage/uploads/photos/comp_cards/'.$this->comp_card)."?".rand();
    }

    public function getAvailabilityAttribute() 
    {
        $today = Carbon::today();
        $availability = 'AVAILABLE ON REQUEST';

        $availabilities = $this->availabilities;

        foreach ($availabilities as $a) {
            $start = Carbon::parse($a->starts_at);
            $end = Carbon::parse($a->ends_at);
            if ($today->between($start, $end) || $today == $start) {
                $availability = 'AVAILABLE NOW';
                // break;
            } elseif ($today < $start) {
                $diff = $today->diffInDays($start);
                $availability = "AVAILABLE IN {$diff} ".str_plural('DAY', $diff);
                // break;
            }

        }

        return $availability;
    }

    public function getSkillsAttribute() 
    {
        $skills = ModelSkill::where('model_id', $this->id)->get();

        $data = [];

        foreach ($skills as $i) {
            $data[] = $i->skill_id; 
        }

        return $data;
    }

    public function getExperiencesAttribute()
    {
        $exps = ExperienceModel::where('model_id', $this->id)->get();

        $data = [];

        foreach ($exps as $i) {
            $data[] = $i->experience_id; 
        }
        
        return $data;
    }

    // public function getLanguagesAttribute()
    // {
    //     $langs = LanguageModel::where('model_id', $this->id)->get();

    //     $data = [];

    //     foreach ($langs as $i) {
    //         $data[] = $i->language_id;
    //     }
        
    //     return $data;
    // }

    public function getExclusiveLabelAttribute() 
    {
        return $this->exclusive ? 'EXCLUSIVE' : '';
    }

    public function models_clips()
    {
        return $this->hasMany(ModelsClip::class, 'model_id');
    }

}
