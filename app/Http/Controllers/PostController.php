<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

// use Illuminate\Support\Facades\Redis;

class PostController extends Controller
{
    /**
     * Display a homepage.
     *
     * @return \Illuminate\Http\Response
     */
    public function homepage()
    {
        $tts = 15;
        $numberOfLastPosts = 5;
        $numberOfTalkedPosts = 3;
        $test = false;

        $jsonLastPosts = Cache::remember('last_posts', now()->addSeconds($tts), function () use ($numberOfLastPosts) {
            $lastPosts = Post::latest('id')
                ->take($numberOfLastPosts)
                ->get();

            return $lastPosts->toJson();
        });
        $jsonMoreTalkedPosts = Cache::remember('more_talked_posts', now()->addSeconds($tts), function ()  use ($numberOfTalkedPosts) {
            $moreTalkedPosts = Post::distinct()
                ->select(
                    DB::raw('posts.*, (SELECT COUNT(comments.id) FROM comments WHERE posts.id = comments.post_id) AS count_comments')
                )
                ->join('comments', 'posts.id', 'comments.post_id')
                ->where('comments.created_at', '>', (new \DateTime('-1 week'))->format('YmdHis'))
                ->orderBy('count_comments', 'DESC')
                ->take($numberOfTalkedPosts)
                ->get();

            return $moreTalkedPosts->toJson();
        });

        $lastPosts = json_decode($jsonLastPosts, true);
        $moreTalkedPosts = json_decode($jsonMoreTalkedPosts, true);

        return view('homepage', [
            'lastPosts' => $lastPosts,
            'numberOfLastPosts' => $numberOfLastPosts,
            'moreTalkedPosts' => $moreTalkedPosts,
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::latest()->paginate(10);
        
        return view('post.index', ['posts' => $posts]);
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
        $pathToImage = Post::DEFAULT_IMAGE_PATH;

        if ($request->hasFile('postImage')) {
            $pathToImage = $request->file('postImage')->store('images');
        }

        $post = new Post([
            'user_id' => $request->user()->id,
            'title' => $validated['postTitle'],
            'content' => $validated['postContent'],
            'image' => $pathToImage,
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
                    ->take(10)
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

        if ($request->hasFile('postImage')) {
            if ($post->image !== Post::DEFAULT_IMAGE_PATH) {
                Storage::delete($post->image);
            }
            $pathToImage = $request->file('postImage')->store('images');
            $post->image = $pathToImage;
        }

        $validated = $request->safe();
        $post->update([
            'title' => $validated['postTitle'],
            'content' => $validated['postContent']
        ]);

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

        if ($post->image !== Post::DEFAULT_IMAGE_PATH) {
            Storage::delete($post->image);
        }

        $post->delete();

        return redirect(route('homepage'));
    }
}
