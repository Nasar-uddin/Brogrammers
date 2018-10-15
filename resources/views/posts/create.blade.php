@extends('layouts.app')
@section('content')
    <div class="col-sm-10 col-sm-push-1">
        <h1>Create new Post</h1>
        <hr>
        <form method="POST" action="{{ route('posts.store') }}" class="">
            {{ csrf_field() }}
            <div class="form-group {{$errors->has('title')? 'has-error' : ''}}">
                <label for="title">Post title</label>
                <input type="text" name="title" class="form-control" value="{{old('title')}}">
                @if ($errors->has('title'))
                    <span class="help-block">
                        <strong>{{ $errors->first('title') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group">
                <label for="body">Post body</label>
                <textarea name="body" id="article-ckeditor" rows="20" class="form-control"></textarea>
                @if ($errors->has('body'))
                    <span class="help-block" style="color:#a94442">
                        <strong>{{ $errors->first('body') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group">
                <input type="file" name="image" class="form-control">
            </div>
            <button class="btn btn-primary">Create post</button>
        </form>
    </div>
    <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'article-ckeditor' );
    </script>
@endsection