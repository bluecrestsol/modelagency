<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as ParentModel;

class ModelsFile extends ParentModel
{
    protected $fillable = [
    	'file_type_id',
    	'model_id',
    	'md5',
    	'extension'
    ];

    public function model() 
    {
    	return $this->belongsTo('App\Models\Model');
    }

    public function file_type()
    {
    	return $this->belongsTo('App\Models\FileType');
    }
}
