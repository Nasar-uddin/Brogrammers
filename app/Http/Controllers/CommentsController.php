<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;

class CommentsController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function store(Request $request){
        $request->validate([
            'comment'=>'required',
            'post_id'=>'required'
        ]);
        $comment = new Comment();
        $comment->comment = $request->input('comment');
        $comment->post_id = $request->input('post_id');
        $comment->user_id = auth()->user()->id;
        $comment->save();
        return redirect('/posts/'.$request->input('post_id'));
    }
}
