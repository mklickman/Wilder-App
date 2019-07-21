<?php

namespace App;

use Auth;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Post extends Model implements HasMedia
{

    use HasMediaTrait;

    protected $fillable = ['user_id', 'title', 'post_date', 'post_content'];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function students() {
        return $this->belongsToMany('App\Student')->withTimestamps();
    }

    public function updatePost($request) {

        $post = $this;

        $post->user_id = Auth::user()->id;
        $post->title = $request->post_title;
        $post->post_date = $request->post_date;
        $post->post_content = $request->post_content;

        $post->students()->detach();
        $post->students()->attach($request->students);
        
        $post->save();
    }
}
