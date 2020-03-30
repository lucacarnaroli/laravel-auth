<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{
    //
    // SOLO PER ADMIN E GUEST
    public function index(){
        $posts = Post::all();

        return view('guest.posts.index',compact('posts'));
    }
}
