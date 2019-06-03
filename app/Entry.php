<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    public function user() {
        return $this->belongsTo('App\User');
    }

    public function students() {
        return $this->belongsToMany('App\Student')->withTimestamps();
    }
}
