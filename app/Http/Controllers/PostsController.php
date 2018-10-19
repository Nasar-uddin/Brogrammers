<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Catagory;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        $this->middleware('auth')->except(['index','show','byuser','bycatagory']);
    }
    public function index()
    {
        $posts = Post::orderBy('created_at','desc')->paginate(10);
        return view('posts.index')->with('posts',$posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $catagories = Catagory::all();
        return view('posts.create')->with('catagories',$catagories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required',
            'body' => 'required',
            'catagory' => 'required',
            'image' => 'image|nullable|max:1999'
        ]);
        if($request->hasFile('image')){
            $imageNameWithExt = $request->file('image')->getClientOriginalName();
            $imageName = pathinfo($imageNameWithExt,PATHINFO_FILENAME);
            $imageExt = $request->file('image')->getClientOriginalExtension();
            $imageNameToSave = $imageName.'_'.time().'.'.$imageExt;
            $path = $request->file('image')->storeAs('public/cover-img',$imageNameToSave);
        }else{
            $imageNameToSave = 'noimage.png';
        }
        $post = new Post();
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->catagory_id = $request->input('catagory');
        $post->user_id = auth()->user()->id;
        $post->image = $imageNameToSave;
        $post->save();
        return redirect('/posts')->with('success','Post has been created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        // return $post;
        return view('posts.show')->with('post',$post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        if(auth()->user()->id!=$post->user_id)
            return redirect('/posts')->with('error','Unauthroized access');
        else
            return view('posts.edit' ,compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title'=>'required',
            'body' => 'required',
            'image' => 'image|nullable|max:1999'
        ]);
        $post = Post::find($id);
        if(auth()->user()->id!=$post->user_id){
            return redirect('/posts')->with('error','Don\'t Fuck with your dad');
        }
        if($request->hasFile('image')){
            $image = $request->file('image');
            $imageNameWithExt = $image->getClientOriginalName();
            $imageName = pathinfo($imageNameWithExt,PATHINFO_FILENAME);
            $imageExt = $image->getClientOriginalExtension();
            if($post->image!='noimage.png')
                Storage::delete('/public/cover-img/'.$post->image);
            $imageNameToSave = $imageName.'_'.time().'.'.$imageExt;
            $path = $request->file('image')->storeAs('public/cover-img',$imageNameToSave);
            $post->image = $imageNameToSave;
        }
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->save();
        return redirect('/posts')->with('success','Post has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        if(auth()->user()->id==$post->user_id){
            if($post->image!='noimage.png')
                Storage::delete('/public/cover-img/'.$post->image);
            $post->delete();
            return redirect('/posts')->with('success','Post has been deleted');
        }
        else
            return redirect('/posts')->with('error','Unauthorized accesss');
    }
    public function byuser($id){
        $posts = Post::where('user_id',$id)->orderBy('created_at','desc')->paginate(3);
        return view('posts.index')->with('posts',$posts);
    }
    public function bycatagory($id){
        $posts = Post::where('catagory_id',$id)->orderBy('created_at','desc')->paginate(2);
        return view('posts.index')->with('posts',$posts);
    }
}
