<?php

namespace Tests\Feature\Auth;

use App\Models\Post;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdatingPostTest extends TestCase
{
    use RefreshDatabase;

    public function test_editing_post_screen_can_be_rendered()
    {
        /** @var Authenticatable $user */
        $user = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $user->id]);

        $response = $this
            ->actingAs($user)
            ->get(sprintf('/post/edit/%d', $post->id));

        $response->assertStatus(200);
    }

    public function test_users_can_update_post()
    {
        /** @var Authenticatable $user */
        $user = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $user->id]);

        $response = $this
            ->actingAs($user)
            ->put(sprintf('/post/update/%d', $post->id), [
                'postTitle' => 'Test Post Title Changed',
                'postContent' => 'Test Post Content Changed',
            ]);
        
        $response->assertStatus(302);
        $response->assertRedirect();
    }
}
