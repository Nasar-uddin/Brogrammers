<?php

namespace App;
use App\User;
use App\Catagory;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	public $timestamps = true;
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function catagory(){
        return $this->belongsTo('App\Catagory');
    }
}
