<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use SoftDeletes;

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function entries() {
        return $this->belongsToMany('App\Entry')->withTimestamps();
    }

    public function posts() {
        return $this->belongsToMany('App\Post')->withTimestamps();
    }

    public function books() {
        return $this->belongsToMany('App\Book')->withTimestamps();
    }

    public function updateStudent($request) {

        $student = $this;

        $student->first_name = $request->first_name;
        $student->last_name = $request->last_name;
        $student->birthday = $request->birthday;
        $student->grade_level_id = $request->grade_level;

        $student->save();
    }

    public function getInitialsAttribute() {
        $firstInitial = substr($this->first_name, 0, 1);
        $lastInitial = substr($this->last_name, 0, 1);

        return "{$firstInitial}{$lastInitial}";
    }

    protected $fillable = [
        'first_name',
        'last_name',
        'birthday',
        'grade_level_id',
        'user_id'
    ];
}
