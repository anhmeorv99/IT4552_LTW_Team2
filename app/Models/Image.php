<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Image extends Model
{
    protected $fillable = [
        'user_id', 'file_name'
    ];

    public function image(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
