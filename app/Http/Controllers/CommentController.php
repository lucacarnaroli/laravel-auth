<?php

namespace App\Http\Controllers;
use App\Comment;
use App\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    // public function __construct()
    // {
    //     $this->validateRole = [
    //         'title' => 'required|string|max:100',
    //         'name' => 'required|string|max:20',
    //         'body' => 'required|string|max:1000',
    //         'email' => 'required|email',
    //         'post_id' => 'required|numeric|exists:posts,id'
    //     ];
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate ([
            'title' => 'required|string|max:100',
            'name' => 'required|string|max:20',
            'body' => 'required|string|max:1000',
            'email' => 'required|email',
            'post_id' => 'required|numeric'
        ]);
       
        $data = $request->all();
       
        $newComment = new Comment;
        
        $newComment->fill($data);
       
        $saved = $newComment->save();
        
        if (!$saved) {
           return redirect()->back();
        }
        
        return redirect()->route('posts.show', $newComment->post->slug);
    }


}
