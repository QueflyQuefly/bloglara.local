<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreatingPostTest extends TestCase
{
    use RefreshDatabase;

    public function test_creating_post_screen_can_be_rendered()
    {
        /** @var Authenticatable $user */
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get('/post/create');

        $response->assertStatus(200);
    }

    public function test_users_can_create_post()
    {
        /** @var Authenticatable $user */
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->post('/post/store', [
                'postTitle' => 'Test Post Title',
                'postContent' => 'Test Post Content',
            ]);

        $response->assertRedirect(RouteServiceProvider::HOME);
    }
}
