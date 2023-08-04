<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCatagory extends Model
{
    use HasFactory;

    public function catagory()
    {
        return $this->belongsTo(Catagory::class);
    }

    public function posts()
    {
        return $this->hasMany(post::class);
    }
}
