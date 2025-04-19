<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompressionLog extends Model
{
    protected $fillable = ['image_id', 'message'];

    public function image()
    {
        return $this->belongsTo(Image::class);
    }
}
