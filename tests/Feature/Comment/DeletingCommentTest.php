<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use App\Providers\RouteServiceProvider;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeletingCommentTest extends TestCase
{
    use RefreshDatabase;

    public function test_not_authors_cannot_delete_comment()
    {
        /** @var Authenticatable $user1 */
        $user1 = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $user1->id]);
        $comment = Comment::factory()->create([
            'user_id' => $user1->id,
            'post_id' => $post->id,
        ]);

        /** @var Authenticatable $user2 */
        $user2 = User::factory()->create();

        $response = $this
            ->actingAs($user2)
            ->delete(sprintf('/comment/delete/%d', $comment->id));

        $this->assertModelExists($comment);
        $response->assertStatus(403);
    }

    public function test_authors_can_delete_comment()
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
            ->delete(sprintf('/comment/delete/%d', $comment->id));

        $this->assertModelMissing($comment);
        $response->assertStatus(302);
        $response->assertRedirect();
    }
}
