<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use App\Models\Post;
use App\Providers\RouteServiceProvider;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreatingCommentTest extends TestCase
{
    use RefreshDatabase;

    public function test_creating_comment_screen_can_be_rendered()
    {
        /** @var Authenticatable $user */
        $user = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->get(sprintf('/comment/create/%s', $post->id));

        $response->assertStatus(200);
    }

    public function test_users_can_create_comment()
    {
        /** @var Authenticatable $user */
        $user = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->post(sprintf('/comment/store/%s', $post->id), [
            'commentContent' => 'Test Comment Content',
        ]);

        $response->assertRedirect();
    }
}
