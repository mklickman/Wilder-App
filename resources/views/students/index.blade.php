@extends('layouts.app')

@section('pageTitle')
    Students
@endsection

@section('pageTitleButton')
    <a href="/students/create" class="btn btn-primary btn-block btn-sm">Add Student</a>
@endsection

@section('content')

    @if ($students)
        <ul>
        @foreach($students as $student)
            <li><a href="/students/{{ $student->id }}">{{ $student->first_name }} {{ $student->last_name }}</a></li>
        @endforeach
        </ul>
    @endif
    
@endsection