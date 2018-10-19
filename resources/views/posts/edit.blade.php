@extends('layouts.app')
@section('content')
    <div class="col-sm-10 col-sm-push-1">
        <h1>Edit your Post</h1>
        <hr>
        <form method="POST" action="{{route('posts.update',$post->id)}}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="PUT">
            <div class="form-group {{$errors->has('title')? 'has-error' : ''}}">
                <label for="title">Post title</label>
                <input type="text" name="title" class="form-control" value="{{$post->title}}">
                @if ($errors->has('title'))
                    <span class="help-block">
                        <strong>{{ $errors->first('title') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group">
                <label for="body">Post body</label>
                <textarea name="body" id="article-ckeditor" rows="20" class="form-control">{{$post->body}}</textarea>
                @if ($errors->has('body'))
                    <span class="help-block" style="color:#a94442">
                        <strong>{{ $errors->first('body') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group">
                <input type="file" class="form-control" name="image">
                @if ($errors->has('image'))
                    <span class="help-block">
                        <strong>{{ $errors->first('image') }}</strong>
                    </span>
                @endif
            </div>
            <button class="btn btn-primary">Update</button>
        </form>
    </div>
    <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'article-ckeditor' );
    </script>
@endsection