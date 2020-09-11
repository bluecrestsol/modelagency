<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as ParentModel;

class Customer extends ParentModel
{
    	protected $appends = ['actions', 'last_login', 'last_booking', 'category_name'];

        protected $fillable = [
            'admin_id',
            'updated_by_admin_id',
            'uuid',
            'last_logged_at',
            'name',
            'status',
            'share',
            'address_line_1',
            'address_line_2',
            'city',
            'province',
            'zip',
            'country_id',
            'phone',
            'email',
            'password',
            'website',
            'contact_name',
            'contact_email',
            'mobile',
            'tax_number',
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

        public function getLastBookingAttribute() {
            return '-'; //temoporary no instructions
        }

        public function getActionsAttribute() {
        	return '<a class="btn btn-info btn-xs" href='.route('customers.show', ['id' => $this->id]).'><i class="fa fa-edit"></i> Show</a>';
        }
}
