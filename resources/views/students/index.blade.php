@extends('layouts.app')

@section('pageTitle')
    Students
@endsection

@section('pageTitleButton')
    @if (count($students))
        <a href="/students/create" class="btn btn-primary btn-block btn-sm">Add Student</a>
    @endif
@endsection

@section('content')

    @if ($students)
        <ul>
        @foreach($students as $student)
            <li><a href="/students/{{ $student->id }}">{{ $student->first_name }} {{ $student->last_name }}</a></li>
        @endforeach
        </ul>
    @else
        <div class="row justify-content-center">
            <div class="col-sm-4">
                <a href="/students/create" class="btn btn-primary btn-block">Add Your First Student</a>
            </div>
        </div>
    @endif
    
@endsection