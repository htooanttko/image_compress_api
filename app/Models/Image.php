<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
        'user_id',
        'original_filename',
        'original_size',
        'original_filepath',

        'compressed_filename',
        'compressed_size',
        'compression_filepath',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function logs()
    {
        return $this->hasMany(CompressionLog::class);
    }
}
