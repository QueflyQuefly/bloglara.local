<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        if (User::where('email', User::ADMIN_EMAIL)->doesntExist()) {
            User::factory()
                ->state([
                    'email' => User::ADMIN_EMAIL,
                    'roles' => '["' . User::ROLE_ADMIN . '"]'
                ])
                ->create();
        }

        $users = User::factory()
            ->count(10)
            ->state(new Sequence(
                ['roles' => '["' . User::ROLE_USER . '"]'],
                ['roles' => '["' . User::ROLE_ADMIN . '"]'],
            ))
            ->create();

        foreach ($users as $user) {
            $posts = Post::factory()
                ->count(5)
                ->for($user)
                ->create();

            foreach ($posts as $post) {
                Comment::factory()
                    ->count(5)
                    ->for($user)
                    ->for($post)
                    ->create();
            }
        }

        
        /* $this->call([
            UserSeeder::class,
            PostSeeder::class,
            CommentSeeder::class,
        ]); */
    }
}
