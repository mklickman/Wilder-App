<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    public function students() {
        return $this->hasMany('App\Student');
    }

    public function entries() {
        return $this->hasMany('App\Entry');
    }

    public function posts() {
        return $this->hasMany('App\Post');
    }

    public function books() {
        return $this->hasMany('App\Book');
    }

    public function addStudent($request) {

        $this->students()->create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'birthday' => $request->birthday,
            'grade_level_id' => $request->grade_level
        ]);

    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
