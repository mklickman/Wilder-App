@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-sm-9">Activities</div>
                <div class="col-sm-3">
                    @if ($entries)
                        <a href="/entries/create" class="btn btn-primary btn-block btn-sm">Add Entry</a>
                    @endif
                </div>
            </div>
        </div>

        <div class="card-body">

            @if ($entries)
                <table class="table">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Activity Type</th>
                            <th>Duration</th>
                            <th>Students</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($entries as $entry)
                            <tr>
                                <td>{{ date('m/d/Y', strtotime($entry->entry_date)) }}</td>
                                <td>{{ $entry->activityType->name }}</td>
                                <td>{{ $entry->duration_hours }}:{{ $entry->duration_minutes }}</td>
                                <td>
                                    @foreach($entry->students as $student)
                                        <span class="student-badge bg-info">{{ $student->initials }}</span>
                                        {{-- {{ $student->id }}) {{ $student->first_name }} {{ $student->last_name }}<br> --}}
                                    @endforeach
                                </td>
                                <td><a class="btn btn-outline-primary btn-block btn-sm" href="/entries/{{ $entry->id }}/edit">edit</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="row justify-content-center">
                    <div class="col-sm-4">
                        <a href="/entries/create" class="btn btn-primary btn-block">Add Your First Entry</a>
                    </div>
                </div>
            @endif
@endsection