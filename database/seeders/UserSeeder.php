<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Sequence;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()
            ->count(10)
            ->state(new Sequence(
                ['roles' => [User::ROLE_USER]],
                ['roles' => [User::ROLE_ADMIN, User::ROLE_USER]],
            ))
            ->create();
    }
}
