<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Entry extends Model
{

    use SoftDeletes;

    protected $fillable = ['entry_date', 'duration_hours', 'duration_minutes', 'notes', 'activity_type_id'];

    public $with = ['students'];

    public function activityType() {
        return $this->belongsTo('App\ActivityType');
    }

    public function students() {
        return $this->belongsToMany('App\Student')->withTimestamps();
    }

    public function updateEntry($request) {
        
        $entry = $this;

        $entry->activity_type_id = $request->activity_type;
        $entry->entry_date = $request->activity_date;
        $entry->duration_hours = $request->duration_hours;
        $entry->duration_minutes = $request->duration_minutes;
        $entry->notes = $request->notes;

        $entry->students()->detach();
        $entry->students()->attach($request->students);
        
        $entry->save();
    }
}
