<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Cache;

// use Illuminate\Support\Facades\Redis;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jsonString = Cache::remember('last_posts', now()->addSeconds(15), function () {
            $posts = Post::orderBy('id', 'desc')
                ->take(10)
                ->get();

            return $posts->toJson();
        });

        $posts = json_decode($jsonString, true);

        return view('homepage', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        $validated = $request->safe();
        $post = new Post([
            'user_id' => $request->user()->id,
            'title' => $validated['postTitle'],
            'content' => $validated['postContent'],
        ]);
        $post->saveOrFail();

        return redirect(route('homepage'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $jsonString = Cache::remember(
            sprintf('post_%s_comments', $post->id),
            now()->addSeconds(15),
            function () use ($post) {
                $comments = Comment::where('post_id', $post->id)
                    ->orderBy('id', 'DESC')
                    ->get();

                return $comments->toJson();
            }
        );

        $comments = json_decode($jsonString, true);

        return view('post.show', ['post' => $post, 'comments' => $comments]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $this->authorize('update', $post);

        return view('post.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $this->authorize('update', $post);

        $validated = $request->safe();
        $post->title = $validated['postTitle'];
        $post->content = $validated['postContent'];
        $post->update();

        return redirect(route('post.show', ['post' => $post]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        $post->delete();

        return redirect(route('homepage'));
    }
}
