<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as ParentModel;

class ModelSkill extends ParentModel
{
    protected $table = 'model_skill';

    protected $guarded = ['id'];
    
    public function skill()
    {
    	return $this->belongsTo('App\Models\Skill');
    }

}
