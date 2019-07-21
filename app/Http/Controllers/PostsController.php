<?php

namespace App\Http\Controllers;

use App\Post;

use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('posts/index', [
            'posts' => Auth::user()->posts->all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts/create', [
            'students' => Auth::user()->students->all(),
            'current_date' => Carbon::now()->toDateString()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'students' => 'required|array|min:1',
            'post_title' => 'required',
            'post_date' => 'required'
        ]);

        $post = Post::create([
            'user_id' => Auth::user()->id,
            'title' => $request->post_title,
            'post_date' => $request->post_date,
            'post_content' => $request->post_content
        ]);

        if ($request->hasFile('post_image')) {
            $filename = time() . '_' . $request->file('post_image')->getClientOriginalName();
            $post->addMedia($request->file('post_image'))->setFileName($filename)->toMediaCollection();
        }

        $post->students()->attach($request->students);
        
        $post->save();

        flash("Post saved successfully");

        return redirect('/posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('posts/show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts/edit', [
            'post' => $post,
            'students' => Auth::user()->students->all(),
            'post_date' => Carbon::create($post->post_date)->toDateString()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'students' => 'required|array|min:1',
            'post_title' => 'required',
            'post_date' => 'required'
        ]);

        if(array_key_exists('photos_to_delete', $request)) {
            foreach($request->photos_to_delete as $i) {
                $post->find($post->id)->getMedia()->find($i)->delete();
            }
        }

        $post->find($post->id)->updatePost($request);

        flash("Post successfully updated");

        return redirect('/posts/' . $post->id . '/edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        flash('Post deleted');

        return redirect('/posts');
    }
}
