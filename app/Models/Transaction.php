<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as ParentModel;

class Transaction extends ParentModel
{
	protected $fillable = [
		'uuid',
		'happened_at',
		'transaction_type_id',
		'customer_id',
		'amount',
		'invoice',
		'vat',
		'tax',
		'agency_id',
		'agency_share',
		'agency_amount',
		'model_id',
		'model_share',
		'model_amount',
		'company_amount',
		'admin_id',
		'note',	
	];

	public function getActionsAttribute() {
		return '<a class="btn btn-info btn-xs" href='.route('transactions.show', ['id' => $this->id]).'><i class="fa fa-edit"></i> Show</a>';
	}

	public function getInvoiceAttribute($value) {
		return $value ? 1:0;
	}

	public function model() {
		return $this->belongsTo(Model::class);
	}

	public function customer() {
		return $this->belongsTo(Customer::class);
	}

	public function admin() {
		return $this->belongsTo(Admin::class);
	}

	public function getTransactionTypeAttribute() {
		return config("constants.transaction_types.types.{$this->transaction_type_id}");
	}

}
