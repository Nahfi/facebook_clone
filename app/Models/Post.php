<?php

namespace App\Models;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $guarded=[


    ];



    public function use(){
        
        return $this->belongsTo(User::class,"user_id","id");
    }
    public function post_comment(){
        return $this->hasMany(Comment::class);
    }
}
