<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as ParentModel;
use App\Models\Admin;
use Carbon\Carbon;

class Note extends ParentModel
{
    protected $fillable = [
        'created_by_admin_id',
    	'updated_by_admin_id',
    	'owner',
    	'owner_id',
    	'note',
    ];

    public function getCreatedByAttribute() {
    	return Admin::find($this->created_by_admin_id)->full_name;
    }

    public function getFormattedCreatedAtAttribute() {
    	return Carbon::parse($this->created_at)->toDayDateTimeString();
    }
}
