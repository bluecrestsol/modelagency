<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as ParentModel;
 
class FileType extends ParentModel
{
    protected $fillable = [
    	'name',
    	'owner_type',
        'owner_id'
    ];

    public function getOwnerAttribute() {
    	return ucfirst(config("constants.file_types.owner_types.{$this->owner_type}"));
    }

    public function model() {
    	return $this->belongsTo('App\Models\Model');
    }
}
