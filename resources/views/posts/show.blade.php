@extends('layouts.app')
@section('content')
    <div class="col-sm-10">
    	<div class="well row card">
            <h1>{{$post->title}}</h1>
            <hr>
            <div class="post-meta">
                <a href="#" class="meta-item">{{ $post->user->name }}</a>
                on {{ $post->created_at }}
            </div>
            <hr>
            <p>{{$post->body}}</p>
            <div class="col-sm-8 col-xs-push-2 col-sm-push-2">
                <img class="img-responsive" src="/storage/cover-img/{{ $post->image}}" alt="{{$post->image}}">
            </div>
        </div>
    </div>
    {{-- Show popular items --}}
    @include('inc.popular')
@endsection