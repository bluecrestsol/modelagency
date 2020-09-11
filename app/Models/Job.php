<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $guarded = ['id'];

    public function jobs_photos()
    {
    	return $this->hasMany(JobsPhoto::class, 'job_id');
    }

    public function jobs_clips()
    {
    	return $this->hasMany(JobsClip::class, 'job_id');
    }

    public function getPublishedAtAttribute($value)
    {
        return Carbon::parse($value)->toDateString();
    }

    public function getThumbLinkAttribute()
    {
    	return asset('storage/uploads/thumbs/jobs/'.$this->thumb);
    }

    public function model1()
    {
        return $this->hasOne('App\Models\Model', 'id', 'model1_id');
    }

    public function model2()
    {
        return $this->hasOne('App\Models\Model', 'id', 'model2_id');
    }

    public function model3()
    {
        return $this->hasOne('App\Models\Model', 'id', 'model3_id');
    }
}
