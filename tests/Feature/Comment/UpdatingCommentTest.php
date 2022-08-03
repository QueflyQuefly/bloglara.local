<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use App\Providers\RouteServiceProvider;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdatingCommentTest extends TestCase
{
    use RefreshDatabase;

    public function test_editing_comment_screen_can_be_rendered()
    {
        /** @var Authenticatable $user */
        $user = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $user->id]);
        $comment = Comment::factory()->create([
            'user_id' => $user->id,
            'post_id' => $post->id,
        ]);

        $response = $this
            ->actingAs($user)
            ->get(sprintf('/comment/edit/%d', $comment->id));

        $response->assertStatus(200);
    }

    public function test_users_can_update_comment()
    {
        /** @var Authenticatable $user */
        $user = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $user->id]);
        $comment = Comment::factory()->create([
            'user_id' => $user->id,
            'post_id' => $post->id,
        ]);

        $response = $this
            ->actingAs($user)
            ->put(sprintf('/comment/update/%d', $comment->id), [
                'commentContent' => 'Test Comment Content',
            ]);

        $response->assertStatus(302);
        $response->assertRedirect();
    }
}
