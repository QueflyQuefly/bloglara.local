<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;

class SearchController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function index(SearchRequest $request)
    {
        $request = $request->safe();
        $search = $request['search'] ?? '';

        if ($search === '') {
            $users = $posts = $comments = [];
        } else {
            $users = User::where('name', 'LIKE', "%$search%")
                ->orWhere('email', 'LIKE', "%$search%")
                ->take(5)
                ->get();
            $posts = Post::where('title', 'LIKE', "%$search%")
                ->orWhere('content', 'LIKE', "%$search%")
                ->take(5)
                ->get();

            $comments = Comment::where('content', 'LIKE', "%$search%")
                ->take(5)
                ->get();
        }


        return view('search.index', [
            'search' => $search,
            'users' => $users,
            'posts' => $posts,
            'comments' => $comments,
        ]);
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function searchUsers(SearchRequest $request)
    {
        $request = $request->safe();
        $search = $request['search'] ?? '';

        if ($search === '') {
            $users = [];
        } else {
            $users = User::where('name', 'LIKE', "%$search%")
                ->orWhere('email', 'LIKE', "%$search%")
                ->paginate(10);
        }
        
        return view('search.users', [
            'search' => $search,
            'users' => $users,
        ]);
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function searchPosts(SearchRequest $request)
    {
        $request = $request->safe();
        $search = $request['search'] ?? '';

        if ($search === '') {
            $posts = [];
        } else {
            $posts = Post::where('title', 'LIKE', "%$search%")
                ->orWhere('content', 'LIKE', "%$search%")
                ->paginate(10);
        }

        return view('search.posts', [
            'search' => $search,
            'posts' => $posts,
        ]);
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function searchComments(SearchRequest $request)
    {
        $request = $request->safe();
        $search = $request['search'] ?? '';

        if ($search === '') {
            $comments = [];
        } else {
            $comments = Comment::where('content', 'LIKE', "%$search%")
                ->paginate(10);
        }

        return view('search.comments', [
            'search' => $search,
            'comments' => $comments,
        ]);
    }
}
