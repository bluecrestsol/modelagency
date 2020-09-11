<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BooksItem extends Model
{
    protected $guarded = ['id'];

    public function image()
    {
        return $this->belongsTo(ModelsImage::class, 'models_photo_id');
    }

    public function clip()
    {
        return $this->belongsTo(ModelsClip::class, 'models_clip_id');
    }
}
