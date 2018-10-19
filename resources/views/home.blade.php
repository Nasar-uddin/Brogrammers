@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if(count($posts)>0)
                        <h1 class="text-center">Your posts</h1>
                        <hr>
                        <table class="table table-striped">
                            <tr>
                                <th>Title</th>
                                <th>Title</th>
                                <th>Title</th>
                            </tr>
                            @foreach ($posts as $post)
                                <tr>
                                    <td><a href="/posts/{{$post->id}}">{{$post->title}}</a></td>
                                    <td><a href="/posts/{{$post->id}}/edit" class="btn btn-primary">Edit post</a></td>
                                    <td><form action="{{route('posts.destroy',$post->id)}}" method="POST" class="pull-right">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button class="btn btn-danger">Delete post</button>
                                    </form></td>
                                </tr>
                            @endforeach
                        </table>
                        @else
                        <h1 class="text-center">You have no post</h1>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
