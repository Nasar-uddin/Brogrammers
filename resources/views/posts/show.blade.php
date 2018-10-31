@extends('layouts.app')
@section('content')
    <div class="col-sm-10">
    	<div class="well row card">
            <div class="col-sm-12">

                <div class="post-meta pull-right">
                    <strong><a href="/posts/catagory/{{$post->catagory_id}}" class="meta-item">{{$post->catagory->catagory}}</a>. </strong>
                    posted by
                    <strong><a href="/posts/user/{{$post->user_id}}" class="meta-item">{{ $post->user->name }}</a></strong>
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
        <hr>
        @guest
            <p>Login to Comment</p>
        @else
        <form method="POST" action="/comment">
            {{ csrf_field() }}
            <input type="hidden" name="post_id" value="{{$post->id}}">
            <div class="form-group">
                <label for="Comment">Comment as {{auth()->user()->name}}</label>
                <textarea name="comment" rows="5" class="form-control" id="article-ckeditor"></textarea>
            </div>
            <button class="btn btn-primary pull-right">Comment</button>
            </form>
        @endguest
        <br>
        <hr>
        @if(count($comment)>0)
            <div class="">
                @foreach ($comment as $c)
                    <div class="well">
                        <h5><a href="/posts/user/{{ $c->user->id }}">{{$c->user->name}}</a> on {{$c->created_at}}</h5>
                        <p>{!! $c->comment !!}</p>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
    {{-- Show popular items --}}
    @include('inc.popular')
    <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'article-ckeditor' );
    </script>
@endsection
