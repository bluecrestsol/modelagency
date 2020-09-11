<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeaturesCategory extends Model
{
    protected $guarded = ['id'];

    public function __construct(array $attributes = array())
    {
    	$seq = $this->count();

        $this->setRawAttributes(array(
          'seq' => ($seq + 1),
        ), true);
        parent::__construct($attributes);
    }

    public function features()
    {
    	return $this->hasMany('App\Models\Feature')->orderBy('name');
    }
}
