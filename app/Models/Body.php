<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as ParentModel;

class Body extends ParentModel
{
    protected $fillable = [
    	'owner',
    	'name'
    ];
}
