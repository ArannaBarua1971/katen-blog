<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catagory extends Model
{
    use HasFactory;

    public function subcatagories()
    {
        return $this->hasMany(SubCatagory::class);
    }

    public function posts()
    {
        return $this->hasMany(post::class);
    }
}
