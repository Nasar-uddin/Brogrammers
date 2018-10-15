@extends('layouts.app')
@section('content')
    <div class="col-sm-10">
    	@foreach ($posts as $post)
            <div class="well row card">
                <div class="col-sm-9">
                    <h4><a href="#">Ui/Ux design</a></h4>
                    <h2><a href="{{'posts/'.$post->id}}">{{ $post->title }}</a></h2>
                    <div class="post-meta">
                        <a href="#" class="meta-item">{{ $post->user->name }}</a>
                        on {{ $post->created_at }}
                    </div>
                </div>
                <div class="col-sm-3 card-img">
                <img class="img-responsive" src="/storage/cover-img/{{ $post->image}}" alt="{{$post->image}}">
                </div>
            </div>
        @endforeach
    </div>
    {{-- Show popular items --}}
    @include('inc.popular')
@endsection