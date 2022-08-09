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
        $maxResults = 5;

        $users = User::latest('id')
            ->take($maxResults)
            ->get();

        $posts = Post::latest('id')
            ->take($maxResults)
            ->get();
        
        $comments = Comment::latest('id')
            ->take($maxResults)
            ->get();

        return view('admin.index', [
            'maxResults' => $maxResults,
            'users' => $users,
            'posts' => $posts,
            'comments' => $comments,
        ]);
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function showUsers()
    {
        $users = User::latest('id')
            ->paginate(10);
        
        return view('admin.users', ['users' => $users]);
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function showPosts()
    {
        $posts = Post::latest('id')
            ->paginate(10);
        
        return view('admin.posts', ['posts' => $posts]);
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function showComments()
    {
        $comments = Comment::latest('id')
            ->paginate(10);
        
        return view('admin.comments', ['comments' => $comments]);
    }
}
