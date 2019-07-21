@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">Edit Post</div>

        <div class="card-body">

            <form action="/posts/{{ $post->id }}" method="POST">
                @method('PATCH')
                @csrf

                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger">
                            {{ $error }}
                        </div>
                    @endforeach
                @endif

                <div class="form-group row">
                    <div class="col">
                        <div class="photo-edit-grid">
                            @foreach ($post->getMedia() as $img)
                                <div class="photo">
                                    <input type="checkbox" name="photos_to_delete[]" value="{{ $img->id }}">
                                    <i class="fas fa-trash-alt"></i>
                                    <span class="image-overlay"></span>
                                    <img src="/storage/{{ $img->id }}/{{ $img->file_name }}" alt="">
                                </div>
                            @endforeach
                            <div class="photo add-more">
                                <input type="file" @change="addFileInput()">
                                <i class="fas fa-plus"></i>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="post_title">Title</label>
                    <div class="col-sm-10">
                        <input type="text" name="post_title" id="post_title" class="form-control" value="{{ $post->title }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="post_date">Date</label>
                    <div class="col-sm-10">
                        <input type="date" name="post_date" id="post_date" class="form-control" value="{{ $post_date }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Students</label>
                    <div class="col-sm-10 row">
                        @foreach($students as $student)
                            <div class="col-sm-4">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="student_{{ $student->id }}" name="students[]" value="{{ $student->id }}" @if($post->students->contains($student)) checked @endif>
                                    <label class="form-check-label" for="student_{{ $student->id }}">
                                        {{ $student->id }}) {{ $student->first_name }} {{ $student->last_name }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="post_title">Content</label>
                    <div class="col-sm-10">
                        <textarea name="post_content" id="post_content" rows="10" class="form-control">{{ $post->post_content }}</textarea>
                    </div>
                </div>
                <div class="clearfix">
                    <button type="submit" class="btn btn-primary float-right">Update Post</button>
                </div>
            </form>
        </div>
    </div>

    <form action="/posts/{{ $post->id }}" method="POST" class="mt-5" onsubmit="return confirm('Are you sure you want to delete this post?');">
        @method('DELETE')
        @csrf

        <input type="submit" class="btn btn-outline-danger btn-block" value="Delete Post">
    </form>
@endsection