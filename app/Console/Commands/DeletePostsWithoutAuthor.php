<?php

namespace App\Console\Commands;

use App\Models\Post;
use Illuminate\Console\Command;

class DeletePostsWithoutAuthor extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:posts {--user=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deleting Posts without an Author';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(Post $post)
    {
        $userId = $this->option('user');

        if (empty($userId) || $userId < 1) {
            $this->error('Invalid option, it must be an integer > 0');
            return 1;
        }

        $posts = Post::where('user_id', $userId)->get();
        $bar = $this->output->createProgressBar(count($posts));
        $bar->start();

        foreach ($posts as $posts) {
            $post->delete();
            $bar->advance();
        }

        $bar->finish();
        $this->newLine();

        return 0;
    }
}
