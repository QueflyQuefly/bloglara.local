<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;

class AdminController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect(route('admin.posts'));
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function showUsers()
    {
        $users = User::orderBy('id', 'DESC')->paginate(10);
        
        return view('admin.users', ['users' => $users]);
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function showPosts()
    {
        $posts = Post::orderBy('id', 'DESC')->paginate(10);
        
        return view('admin.posts', ['posts' => $posts]);
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function showComments()
    {
        $comments = Comment::orderBy('id', 'DESC')->paginate(10);
        
        return view('admin.comments', ['comments' => $comments]);
    }
}
