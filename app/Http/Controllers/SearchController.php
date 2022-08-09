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
        $users = $posts = $comments = [];
        $maxResults = 5;

        if ($search !== '') {
            $users = User::where('name', 'LIKE', "%$search%")
                ->orWhere('email', 'LIKE', "%$search%")
                ->take($maxResults)
                ->get();
            $posts = Post::where('title', 'LIKE', "%$search%")
                ->orWhere('content', 'LIKE', "%$search%")
                ->take($maxResults)
                ->get();
            $comments = Comment::where('content', 'LIKE', "%$search%")
                ->take($maxResults)
                ->get();
        }

        return view('search.index', [
            'search' => $search,
            'maxResults' => $maxResults,
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
        $users = [];
        $resultsOnPage = 10;

        if ($search !== '') {
            $users = User::where('name', 'LIKE', "%$search%")
                ->orWhere('email', 'LIKE', "%$search%")
                ->paginate($resultsOnPage)
                ->withQueryString();
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
        $searchByAuthor = $request['searchByAuthor'] ?? '';
        $posts = [];
        $resultsOnPage = 10;

        if ($search !== '' && $searchByAuthor !== '') {
            $posts = Post::latest('posts.id')
                ->select('posts.*')
                ->join('users', 'posts.user_id', 'users.id')
                ->where('users.name', 'LIKE', "%$search%")
                ->paginate($resultsOnPage)
                ->withQueryString();
        } elseif ($search !== '') {
            $posts = Post::where('title', 'LIKE', "%$search%")
                ->orWhere('content', 'LIKE', "%$search%")
                ->paginate($resultsOnPage)
                ->withQueryString();
        }

        return view('search.posts', [
            'search' => $search,
            'searchByAuthor' => $searchByAuthor,
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
        $searchByAuthor = $request['searchByAuthor'] ?? '';
        $comments = [];
        $resultsOnPage = 10;

        if ($search !== '' && $searchByAuthor !== '') {
            $comments = Comment::latest('comments.id')
                ->select('comments.*')
                ->join('users', 'comments.user_id', 'users.id')
                ->where('users.name', 'LIKE', "%$search%")
                ->paginate($resultsOnPage)
                ->withQueryString();
        } elseif ($search !== '') {
            $comments = Comment::where('content', 'LIKE', "%$search%")
                ->paginate($resultsOnPage)
                ->withQueryString();
        }

        return view('search.comments', [
            'search' => $search,
            'searchByAuthor' => $searchByAuthor,
            'comments' => $comments,
        ]);
    }
}
