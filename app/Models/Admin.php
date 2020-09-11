<?php

namespace App\Models;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Model as ParenModel;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
	
    protected $guarded = ['id'];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getFullNameAttribute() 
    {
    	return $this->first_name.' '.$this->last_name;
    }

    public function getCompleteNameAttribute()
    {
    	return $this->nick_name ? $this->full_name . " ({$this->nick_name})" : $this->full_name;
    }

    public function getTitleDescAttribute()
    {
        return config("constants.admins.title.{$this->title}");
    }

    public function getStatusDescAttribute()
    {
        return config("constants.admins.status.{$this->status}");
    }

    public static function generateUuid()
    {
    	$uuid = strtolower(str_random(8));
        if( Admin::where('uuid', $uuid)->first() ) {
            $uuid = strtolower(str_random(8));
        }
        return $uuid;
    }


}
