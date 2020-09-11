<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as ParentModel;

class File extends ParentModel
{
    protected $guarded = ['id'];

    public function file_type()
    {
    	return $this->belongsTo('App\Models\FileType');
    }
}
