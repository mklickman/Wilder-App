@extends('layouts.app')

@section('pageTitle')
    Edit Student
@endsection

@section('content')
    <div class="card">
        <div class="card-header">@yield('pageTitle')</div>

        <div class="card-body">
       
            <form action="/students/{{ $student->id }}" method="POST">
                @method('PATCH')
                @csrf

                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger">
                            {{ $error }}
                        </div>
                    @endforeach
                @endif

                <div class="form-group">
                    <label for="first_name">First Name</label>
                    <input type="text" name="first_name" id="first_name" class="form-control" value="{{ $student->first_name }}">
                </div>
                <div class="form-group">
                    <label for="last_name">Last Name</label>
                    <input type="text" name="last_name" id="last_name" class="form-control" value="{{ $student->last_name }}">
                </div>
                <div class="form-group">
                    <label for="birthday">Birthday</label>
                    <input type="date" name="birthday" id="birthday" class="form-control" value="{{ $student->birthday }}">
                </div>
                <div class="form-group">
                    <label for="grade_level">Grade Level</label>
                    <select name="grade_level" class="form-control">
                        <option>Select grade level...</option>
                        @foreach ($grade_levels as $level)
                            <option value="{{ $level->id }}"{{ $level->id == $student->grade_level_id ? ' selected' : '' }}>{{ $level->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="clearfix">
                    <a href="/students/{{ $student->id }}" class="text-danger float-left">cancel</a>
                    <button type="submit" class="btn btn-primary float-right">Update Student</button>
                </div>
            </form>
        </div>
    </div>
@endsection