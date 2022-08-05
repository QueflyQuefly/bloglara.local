<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShowingUserTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_open_his_profile()
    {
        /** @var Authenticatable $user */
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get(sprintf('/user/%d', $user->id));

        $response->assertStatus(200);
    }

    public function test_user_can_open_other_user_profile()
    {
        /** @var Authenticatable $user1 */
        $user1 = User::factory()->create();

        /** @var Authenticatable $user2 */
        $user2 = User::factory()->create();

        $response = $this
            ->actingAs($user2)
            ->get(sprintf('/user/%d', $user1->id));

        $response->assertStatus(200);
    }

    public function test_guests_can_open_user_profile()
    {
        /** @var Authenticatable $user */
        $user = User::factory()->create();

        $response = $this->get(sprintf('/user/%d', $user->id));

        $response->assertStatus(200);
    }
}
