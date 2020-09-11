<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    protected $guarded = ['id'];

    public function category()
    {
    	return $this->belongsTo('App\Models\FeaturesCategory', 'features_category_id');
    }
}
