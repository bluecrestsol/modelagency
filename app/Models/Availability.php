<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as ParentModel;
use Carbon\Carbon;
class Availability extends ParentModel
{
    protected $fillable = [
    	'created_by_admin_id',
    	'starts_at',
        'ends_at',
    	'agency_id',
    	'model_id',
        'type',
    ];

    public function getEndsAtAttribute($value) {
    	return Carbon::parse($value)->toDateString();
    }

    public function getStartsAtAttribute($value) {
    	return Carbon::parse($value)->toDateString();
    }

}
