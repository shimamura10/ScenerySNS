<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;

class PostController extends Controller
{
    public function index(Post $post, Request $request, User $user)
    {
        if (!empty($request->target)) {
            $posts = $post->orderBy('updated_at', 'DESC')->whereRaw('MATCH(body) AGAINST(? IN BOOLEAN MODE)', [$request->target])->limit(10)->get();
        } else {
            $posts = $post->orderBy('updated_at', 'DESC')->limit(10)->get();
        }
        $users = $user->get();
        // dd($posts);
        return view('index')->with(['posts' => $posts, 'users' => $users]);
    }
    
    public function search(Post $post, Request $request)
    {
        $posts = $post->orderBy('updated_at', 'ASC')->whereRaw('MATCH(body) AGAINST(? IN BOOLEAN MODE)', [$request->target])->limit(10)->get();
        dd($posts);
        return view('index')->with(['posts' => $posts]);
    }
    
    public function store(Request $request)
    {
        $dir = "images";
        $file_name = $request->file('image')->getClientOriginalName();
        $request->file('image')->storeAs('public/' . $dir, $file_name);
        
        $post = new Post();
        $post->body = $request->body;
        $post->image_path = 'storage/' . $dir . '/' . $file_name; // シンボリックリンク
        $post->user_id = $request->user_id;
        $post->save();
        
        return redirect()->route('index');
    }
    
    public function destroy(Post $post)
    {
        $post->delete();
        
        return redirect()->route('index');
    }
}
