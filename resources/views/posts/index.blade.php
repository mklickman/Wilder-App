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
        @foreach($posts as $post)
            <div class="card mb-5">
                @if ($post->getMedia()->count())
                    <div class="card-img-top">
                        @foreach($post->getMedia() as $img)
                            <img src="/storage/{{ $img->id }}/{{ $img->file_name }}" alt="">
                        @endforeach
                    </div>
                @endif
                <div class="card-body">
                    <div class="card-text">
                        <h3><a href="/posts/{{ $post->id }}/edit">{{ $post->title }}</a></h3>
                        <p>{{ $post->post_content }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <div class="row justify-content-center">
            <div class="col-sm-4">
                <a href="/posts/create" class="btn btn-primary btn-block">Add Your First Post</a>
            </div>
        </div>
    @endif
    
@endsection