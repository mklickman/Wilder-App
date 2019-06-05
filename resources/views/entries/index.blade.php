@extends('layouts.app')

@section('pageTitle')
    Activities
@endsection

@section('pageTitleButton')
    @if ($entries)
        <a href="/entries/create" class="btn btn-primary btn-block btn-sm">Add Entry</a>
    @endif
@endsection

@section('content')

    @if ($entries)
        <ul>
        @foreach($entries as $entry)
            <li><a href="/entries/{{ $entry->id }}">{{ $entry->activityType->name }}</a></li>
        @endforeach
        </ul>
    @else
        <div class="row justify-content-center">
            <div class="col-sm-4">
                <a href="/entries/create" class="btn btn-primary btn-block">Add Your First Entry</a>
            </div>
        </div>
    @endif
    
@endsection