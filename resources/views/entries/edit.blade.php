@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">Edit Entry</div>
            
        <div class="card-body">

            <form action="/entries/{{ $entry->id }}" method="POST">
                @method('PATCH')
                @csrf

                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger">
                            {{ $error }}
                        </div>
                    @endforeach
                @endif

                <fieldset>
                    <legend>Students</legend>
                    <div class="form-group row">
                        @foreach($students as $student)
                            <div class="col-sm-3">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="student_{{ $student->id }}" name="students[]" value="{{ $student->id }}" @if($entry->students->contains($student)) checked @endif>
                                    <label class="form-check-label" for="student_{{ $student->id }}">
                                        {{ $student->id }}) {{ $student->first_name }} {{ $student->last_name }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </fieldset>
                
                <fieldset>
                    <legend>Entry Details</legend>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label" for="activity_type">Activity Type</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <select name="activity_type" class="form-control">
                                    <option>Select an activity type...</option>
                                    @foreach($activity_types as $type)
                                        <option value="{{ $type->id }}" @if($type->id == $entry->activity_type_id) selected @endif>{{ $type->name }}</option>
                                    @endforeach
                                </select>
                                <div class="input-group-append">
                                    <a href="/activityTypes/create" class="btn btn-outline-primary"><i class="fa fa-plus"></i>&nbsp;&nbsp;New Type</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label" for="activity_date">Activity Date</label>
                        <div class="col-sm-9">
                            <input type="date" class="form-control" name="activity_date" id="activity_date" value="{{ $entry_date }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label" for="entry_date">Duration</label>
                        <div class="col-sm-9 row">
                            <div class="col-sm-6">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="duration-hours">Hours</span>
                                    </div>
                                    <input type="number" value="{{ $entry->duration_hours }}" class="form-control" name="duration_hours" aria-describedby="duration-hours">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="duration-minutes">Minutes</span>
                                    </div>
                                    <input type="number" value="{{ $entry->duration_minutes }}" class="form-control" name="duration_minutes" aria-describedby="duration-minutes">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label" for="entry_date">Notes</label>
                        <div class="col-sm-9">
                            <textarea name="notes" id="notes" rows="5" class="form-control">{{ $entry->notes }}</textarea>
                        </div>
                    </div>
                </fieldset>

                <div class="text-right">
                    <a class="text-danger mr-3" href="{{ url()->previous() }}">cancel</a>
                    <button type="submit" class="btn btn-primary">Update Entry</button>
                </div>
            </form>
        </div>
    </div>

    <form action="/entries/{{ $entry->id }}" method="POST" class="mt-5" onsubmit="return confirm('Are you sure you want to delete this activity?');">
        @method('DELETE')
        @csrf

        <input type="submit" class="btn btn-outline-danger btn-block" value="Delete Entry">
    </form>
@endsection