@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-sm-9">Students</div>
                <div class="col-sm-3">
                    @if (count($students))
                        <a href="/students/create" class="btn btn-primary btn-block btn-sm">Add Student</a>
                    @endif
                </div>
            </div>
        </div>

        <div class="card-body">
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

        </div>
    </div>    
@endsection