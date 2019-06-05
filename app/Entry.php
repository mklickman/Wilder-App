<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{

    public function activityType() {
        return $this->belongsTo('App\ActivityType');
    }

    public function students() {
        return $this->belongsToMany('App\Student')->withTimestamps();
    }
}
