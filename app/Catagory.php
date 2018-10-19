<?php

namespace App;
use App\Post;

use Illuminate\Database\Eloquent\Model;

class Catagory extends Model
{
    public function post(){
        return $this->hasMany('App\Post');
    }
}
