<?php

namespace App\Http\Controllers;

use App\User;
use App\Entry;
use App\ActivityType;

use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EntriesController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Entry $entry)
    {
        return view('entries/index', [
            'entries' => Auth::user()->entriesByDate,
            'activityTypes' => Auth::user()->activityTypes
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('entries/create', [
            'students' => Auth::user()->students->all(),
            'activityTypes' => Auth::user()->activityTypes->all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, ActivityType $activityType, Entry $entry)
    {
        $request->validate([
            'students' => 'required|array|min:1',
            'activity_type' => 'required',
            'activity_date' => 'required'
        ]);

        $entry = Entry::create([
            'activity_type_id' => $request->activity_type,
            'entry_date' => $request->activity_date,
            'duration_hours' => $request->duration_hours,
            'duration_minutes' => $request->duration_minutes,
            'notes' => $request->notes
        ]);

        $entry->students()->attach($request->students);
        
        $entry->save();

        flash("Entry saved successfully");

        return redirect('/entries');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function show(Entry $entry)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function edit(Entry $entry, ActivityType $activityType)
    {
        return view('entries/edit', [
            'entry' => $entry,
            'entry_date' => Carbon::create($entry->entry_date)->toDateString(),
            'students' => Auth::user()->students->all(),
            'activity_types' => $activityType->all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Entry $entry)
    {
        $request->validate([
            'students' => 'required|array|min:1',
            'activity_type' => 'required',
            'activity_date' => 'required'
        ]);
        
        $entry->find($entry->id)->updateEntry($request);

        flash("Entry successfully updated");

        return redirect('/entries');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function destroy(Entry $entry)
    {
        $entry->delete();

        flash('Entry deleted');

        return redirect('/entries');
    }
}
