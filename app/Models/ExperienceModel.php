<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as ParentModel;

class ExperienceModel extends ParentModel
{
 	protected $table = 'experience_model'; 

 	protected $guarded = ['id'];

 	public function experience() 
 	{
 		return $this->belongsTo('App\Models\Experience');
 	}
}
