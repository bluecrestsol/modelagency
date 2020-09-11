<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as ParentModel;

class Enquiry extends ParentModel
{
    protected $fillable = [

    	'uuid',
    	'model_id',
    	'from_name',
    	'from_company',
    	'from_email',
    	'from_mobile',
    	'from_ip',
    	'from_geo_country_iso',
        'message'

    ];

    public function country()
    {
        return $this->belongsTo('App\Models\Country', 'from_geo_country_iso', 'iso');
    }

    public function model()
    {
        return $this->belongsTo('App\Models\Model');
    }
}
