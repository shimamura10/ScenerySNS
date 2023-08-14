<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index(Post $post)
    {
        $posts = $post->orderBy('updated_at', 'DESC')->limit(10)->get();
        return view('index')->with(['posts' => $posts]);
    }
    
    public function store(Request $request)
    {
        $dir = "images";
        $file_name = $request->file('image')->getClientOriginalName();
        $image_path = 
        $request->file('image')->storeAs('public/' . $dir, $file_name);
        
        $post = new Post();
        $post->body = $request->body;
        $post->image_path = 'storage/' . $dir . '/' . $file_name; // シンボリックリンク
        $post->save();
        
        return redirect()->route('posts.index');
    }
}
