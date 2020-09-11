<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as ParentModel;

class ModelsImage extends ParentModel
{
	protected $table = 'models_photos';
    protected $guarded = ['id'];
}
