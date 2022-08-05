<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $jsonPosts = Cache::remember(
            sprintf('user_%s_posts', $user->id), 
            now()->addSeconds(15),
            function () use ($user) {
                $posts = Post::latest()
                    ->where('user_id', $user->id)
                    ->take(10)
                    ->get();

                return $posts->toJson();
            }
        );

        $posts = json_decode($jsonPosts, true);

        $jsonComments = Cache::remember(
            sprintf('user_%s_comments', $user->id), 
            now()->addSeconds(15), 
            function () use ($user) {
                $comments = Comment::latest()
                    ->where('user_id', $user->id)
                    ->take(10)
                    ->get();

                return $comments->toJson();
            }
        );

        $comments = json_decode($jsonComments, true);

        return view('user.show', [
            'user' => $user,
            'posts' => $posts,
            'comments' => $comments,
        ]);
    }

        /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $this->authorize('update', $user);

        return view('user.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserRequest  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $this->authorize('update', $user);

        $validated = $request->safe();
        $user->update([
            'name' => $validated['name'],
            'password' => Hash::make($validated['password']),
        ]);

        return redirect(route('user.show', ['user' => $user]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->authorize('delete', $user);

        $user->delete();

        return redirect(route('homepage'));
    }
}
