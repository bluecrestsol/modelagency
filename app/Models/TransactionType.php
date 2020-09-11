<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as ParentModel;

class TransactionType extends ParentModel
{
    /*
	$table->increments('id');
	$table->timestamps();
	$table->integer('type')->comment("1=booking,2=expense");
	$table->string('name');
    */

    protected $fillable = [
    	'type',
    	'name',
    ];

    public function getTypeAttribute($value) {
        return config('constants.transaction_types.types.'.$value);
    }

    public function getActionsAttribute() {
        return '<a class="btn btn-info btn-xs" href='.route('transaction_types.show', ['id' => $this->id]).'><i class="fa fa-edit"></i> Show</a>';
    }
}
