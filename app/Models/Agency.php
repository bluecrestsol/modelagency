<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as ParentModel;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Agency extends Authenticatable
{
	protected $appends = ['actions', 'last_login'];

    protected $fillable = [
        'name',
        'uuid',
        'password',
        'status',
        'share',
        'tax',
        'address_line_1',
        'address_line_2',
        'city',
        'province',
        'zip',
        'country_id',
        'website',
        'email',
        'phone',
        'contact_person',
        'contact_email',
        'contact_mobile',
        'admin_id',
        'updated_by_admin_id',
        'legal_name',
        'search_name',
    ];

    public function country() {
    	return $this->belongsTo('App\Models\Country');
    }

    public function getCountryNameAttribute(){
        return $this->country->name;
    }

    public function getLastLoginAttribute() {
        if($this->last_logged_at && $this->last_logged_geo)
           return $this->last_logged_at . ' (' .$this->last_logged_geo.')';
    	return '-';
    }

    public function getActionsAttribute() {
    	return '<a class="btn btn-info btn-xs" href='.route('agencies.show', ['id' => $this->id]).'><i class="fa fa-edit"></i> Show</a>';
    }
}
