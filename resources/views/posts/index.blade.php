@extends('layouts.app')
@section('content')
    <div class="col-sm-10">
        @if(count($posts)>0)
    	@foreach ($posts as $post)
            <div class="well row card">
                <div class="col-sm-9">
                    <h4><a href="/posts/catagory/{{$post->catagory_id}}">{{$post->catagory->catagory}}</a></h4>
                    <h2><a href="{{'posts/'.$post->id}}">{{ $post->title }}</a></h2>
                    <div class="post-meta">
                        <a href="/posts/user/{{$post->user_id}}" class="meta-item">{{ $post->user->name }}</a>
                        on {{ $post->created_at }}
                    </div>
                </div>
                <div class="col-sm-3 card-img">
                <img class="img-responsive" src="/storage/cover-img/{{ $post->image}}" alt="{{$post->image}}">
                </div>
            </div>
        @endforeach
        {{$posts->links()}}
        @else
            <h1>No posts</h1>
        @endif
    </div>
    {{-- Show popular items --}}
    @include('inc.popular')
@endsection