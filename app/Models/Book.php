<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $guarded = ['id'];

    public static function generateUuid()
    {
        $uuid = mt_rand(10000000, 99999999);
        while (Book::where('uuid', $uuid)->first()) {
            $uuid = mt_rand(10000000, 99999999);
        }

        return $uuid;
    }

    public function items()
    {
        return $this->hasMany(BooksItem::class);
    }

    public function images()
    {
        return $this->items()->whereNotNull('models_photo_id');
    }

    public function clips()
    {
        return $this->items()->whereNotNull('models_clip_id');
    }

    public function model()
    {
        return $this->belongsTo('App\Models\Model');
    }
}
