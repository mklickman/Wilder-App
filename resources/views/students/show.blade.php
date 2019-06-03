@extends('layouts.app')

@section('pageTitle')
    {{ $student->first_name}} {{ $student->last_name }}
@endsection

@section('pageTitleButton')
    <a href="/students/{{ $student->id }}/edit" class="btn btn-primary btn-sm btn-block">Edit Student</a>
@endsection

@section('content')
    <p class="row">
        <strong class="col-sm-4">Name:</strong>
        <span class="col-sm-8">{{ $student->first_name }} {{ $student->last_name }}</span>
    </p>
    <p class="row">
        <strong class="col-sm-4">Birthday:</strong>
        <span class="col-sm-8">{{ $student->birthday }}</span>
    </p>
    <p class="row">
        <strong class="col-sm-4">Grade Level:</strong>
        <span class="col-sm-8">{{ $grade_level->name }}</span>
    </p>

    <div class="row">
        <form class="col" action="/students/{{ $student->id }}" method="POST">
            @csrf
            @method('DELETE')
            <input type="submit" class="btn btn-outline-danger btn-block" value="Delete Student">
        </form>
    </div>
@endsection