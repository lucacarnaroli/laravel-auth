<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function create()
    {
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:100',
            'body' => 'required|string|max:1000',
        ]);
        $data = $request->all();

        $post = new Post;
        $post->fill($data);
        $post->user_id = Auth::id();
        $post->slug = Str::finish(Str::slug($post->title), rand(1, 10000));
        $post->save();
        return redirect()->route('admin.posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */

}
