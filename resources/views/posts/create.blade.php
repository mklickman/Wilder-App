@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">New Post</div>

        <div class="card-body">

            <form action="/posts" method="POST">
                @csrf

                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger">
                            {{ $error }}
                        </div>
                    @endforeach
                @endif

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="post_title">Title</label>
                    <div class="col-sm-10">
                        <input type="text" name="post_title" id="post_title" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="post_date">Date</label>
                    <div class="col-sm-10">
                        <input type="date" name="post_date" id="post_date" class="form-control" value="{{ $current_date }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Students</label>
                    <div class="col-sm-10 row">
                        @foreach($students as $student)
                            <div class="col-sm-4">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="student_{{ $student->id }}" name="students[]" value="{{ $student->id }}">
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
                        <textarea name="post_content" id="post_content" rows="10" class="form-control"></textarea>
                    </div>
                </div>
                <div class="clearfix">
                    <button type="submit" class="btn btn-primary float-right">Create Post</button>
                </div>
            </form>
        </div>
    </div>
@endsection