<?php

namespace App\Http\Controllers\Admin;

use App\Post;
use App\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Mail\SendNewMail;
use Illuminate\Support\Facades\Mail;

class PostController extends Controller
{
    // SOLO PER ADMIN

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        // se ho più users devo utilizzare il where dove possono vedere solo i loro post
        $posts = Post::where('user_id',\Auth::id())->get();

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $tags = Tag::all();
        return view('admin.posts.create',compact('tags'));
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
            'title'=>'required|string|max:100',
            'body'=>'required|string|max:1000',
        ]);
        $data = $request->all();

        $path = Storage::disk('public')->put('images', $data['img']);

        $post = new Post;
        $post->img = $path;
        $post->fill($data);
        $post->user_id = Auth::id();
        $post->slug = Str::finish(Str::slug($post->title), rand(1, 10000));
        
        $post->save();
        
            $tags = $data['tags'];
            if (!empty($tags)) {
                $post->tags()->attach($tags);
            }
        // al posto di attach posso usare anche sync() = a attach e detach

        Mail::to('mail@mail.it')->send(new SendNewMail($post));
        
        return redirect()->route('admin.posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $post = Post::where('slug',$slug)->first();
        return view('admin.posts.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $tags = Tag::all();
        $data = [
            'tags' => $tags,
            'post' => $post
        ];

        return view('admin.posts.edit', $data);
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
        // update è simile a store però non va inserito il new: perchè andrebbe in contrasto con la funzione upadte()
        $request->validate([
            'title' => 'required|string|max:100',
            'body' => 'required|string|max:1000',
        ]);
        $data = $request->all();

        // $post = new Post;
        $post->fill($data);
        $post->user_id = Auth::id();
        $post->slug = Str::finish(Str::slug($post->title), rand(1, 10000));
        $post->update($data);

        $tags = $data['tags'];
        if (!empty($tags)) {
            $post->tags()->sync($tags);
        }
        return redirect()->route('admin.posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {   
        if (empty($post)) {
            abort('404'); 
        }

        $post->tags()->detach();
        $post->delete();

        
        return redirect()->route('admin.posts.index');
    }
}
