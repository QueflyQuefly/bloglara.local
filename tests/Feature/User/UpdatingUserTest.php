<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdatingUserTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_open_editing_his_profile()
    {
        /** @var Authenticatable $user */
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get(sprintf('/user/edit/%d', $user->id));

        $response->assertStatus(200);
    }

    public function test_guests_cannot_open_editing_profile()
    {
        /** @var Authenticatable $user */
        $user = User::factory()->create();

        $response = $this->get(sprintf('/user/edit/%d', $user->id));

        $response->assertStatus(302);
    }

    public function test_user_cannot_open_other_user_editing_profile()
    {
        /** @var Authenticatable $user1 */
        $user1 = User::factory()->create();

        /** @var Authenticatable $user2 */
        $user2 = User::factory()->create();

        $response = $this
            ->actingAs($user2)
            ->get(sprintf('/user/edit/%d', $user1->id));

        $response->assertStatus(403);
    }

    public function test_user_can_update_profile()
    {
        /** @var Authenticatable $user */
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->put(sprintf('/user/update/%d', $user->id), [
                'name' => 'Test User Name Changed',
                'password' => 'changed-password',
                'password_confirmation' => 'changed-password',
            ]);

        $response->assertRedirect(sprintf('/user/%d', $user->id));
    }

    public function test_user_cannot_update_other_user_profile()
    {
        /** @var Authenticatable $user1 */
        $user1 = User::factory()->create();

        /** @var Authenticatable $user2 */
        $user2 = User::factory()->create();

        $response = $this
            ->actingAs($user2)
            ->put(sprintf('/user/update/%d', $user1->id), [
                'name' => 'Test User Name Changed',
                'password' => 'changed-password',
                'password_confirmation' => 'changed-password',
            ]);

        $response->assertStatus(403);
    }
}
