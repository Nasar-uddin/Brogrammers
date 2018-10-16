<?php

namespace App;
use App\Post;

use Illuminate\Database\Eloquent\Model;

class Catagory extends Model
{
    public function post(){
        $this->hasMany('App\Post');
    }
}
