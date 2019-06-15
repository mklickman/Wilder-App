@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-sm-9">{{ $post->title}}</div>
                <div class="col-sm-3">
                    <a href="/posts/{{ $post->id }}/edit" class="btn btn-primary btn-sm btn-block">Edit Post</a>
                </div>
            </div>
        </div>

        <div class="card-body">
            <p><small><em>Posted on {{ $post->post_date }}</em></small></p>
            <p>{{ $post->post_content }}</p>
        </div>
    </div>

@endsection


