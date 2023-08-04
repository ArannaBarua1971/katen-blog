<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class post extends Model
{
    use HasFactory;

    public function catagory()
    {
        return $this->belongsTo(Catagory::class);
    }

    public function subcatagory()
    {
        return $this->belongsTo(SubCatagory::class, 'sub_catagory_id');
    }

    public function user()
    {
        return $this->belongsTo(user::class);
    }

    public function views()
    {
        return $this->hasMany(postVeiwCount::class);
    }

    public function parentComments()
    {
        return $this->hasMany(Comment::class)->where('parent_id', null)->with('user:id,name,profile_img');
    }

    public function replyComments()
    {
        return $this->hasMany(Comment::class)->where('parent_id', '!=', null)->with('user:id,name,profile_img');
    }
}
