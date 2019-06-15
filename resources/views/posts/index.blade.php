@extends('layouts.app')


@section('content')
    <div class="row">
        <h2 class="col-sm-9">Field Trip Journal</h2>
        <div class="col-sm-3">
            @if ($posts)
                <a href="/posts/create" class="btn btn-primary btn-block btn-sm">New Post</a>
            @endif
        </div>
    </div>

    @if ($posts)
        <ul>
        @foreach($posts as $post)
            <li><a href="/posts/{{ $post->id }}">{{ $post->title }}</a></li>
        @endforeach
        </ul>
    @else
        <div class="row justify-content-center">
            <div class="col-sm-4">
                <a href="/posts/create" class="btn btn-primary btn-block">Add Your First Post</a>
            </div>
        </div>
    @endif
    
@endsection