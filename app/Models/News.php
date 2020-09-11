<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $guarded = ['id'];

    public function news_photos()
    {
    	return $this->hasMany(NewsPhoto::class, 'news_id');
    }

    public function news_clips()
    {
    	return $this->hasMany(NewsClip::class, 'news_id');
    }
}
