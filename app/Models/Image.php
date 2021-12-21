<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
        'user_id', 'file_name'
    ];

    public function image(){
        return $this->belongsTo(Image::class);
    }
}
