<?php

namespace App;
use App\Post;
use App\User;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function post(){
        return $this->belongsTo('App\Post');
    }
    public function user(){
        return $this->BelongsTo('App\User');
    }
}
