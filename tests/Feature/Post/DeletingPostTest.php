<?php

namespace Tests\Feature\Auth;

use App\Models\Post;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeletingPostTest extends TestCase
{
    use RefreshDatabase;

    public function test_not_authors_cannot_delete_post()
    {
        /** @var Authenticatable $user1 */
        $user1 = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $user1->id]);

        /** @var Authenticatable $user2 */
        $user2 = User::factory()->create();

        $response = $this
            ->actingAs($user2)
            ->delete(sprintf('/post/delete/%d', $post->id));

        $response->assertStatus(403);
    }

    public function test_authors_can_delete_post()
    {
        /** @var Authenticatable $user */
        $user = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $user->id]);

        $response = $this
            ->actingAs($user)
            ->delete(sprintf('/post/delete/%d', $post->id));

        $response->assertRedirect(RouteServiceProvider::HOME);
    }
}
