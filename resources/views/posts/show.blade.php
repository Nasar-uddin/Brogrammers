@extends('layouts.app')
@section('content')
    <div class="col-sm-10">
    	<div class="well row card">
            <div class="col-sm-12">
                
                <div class="post-meta pull-right">
                    <strong><a href="#" class="meta-item">{{$post->catagory->catagory}}</a>. </strong>
                    posted by 
                    <strong><a href="#" class="meta-item">{{ $post->user->name }}</a></strong>
                    on {{ $post->created_at }}
                </div>
                <hr>
                <h1>{{$post->title}}</h1>
                <hr>
                <img class="img-responsive" src="/storage/cover-img/{{ $post->image}}" alt="{{$post->image}}">
                <hr>
            </div>
            <div class="col-sm-12">
                <p>{!! $post->body !!}</p>
                <hr>
            </div>
            @if(!Auth::guest()&& Auth::user()->id == $post->user_id)
            <div class="col-sm-12">
                <hr>
                <a href="/posts/{{$post->id}}/edit" class="btn btn-primary">Edit post</a>
                <form action="{{route('posts.destroy',$post->id)}}" method="POST" class="pull-right">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="DELETE">
                    <button class="btn btn-danger">Delete post</button>
                </form>
            </div>
            @endif
        </div>
    </div>
    {{-- Show popular items --}}
    @include('inc.popular')
@endsection