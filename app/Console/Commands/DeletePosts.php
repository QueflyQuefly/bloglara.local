<?php

namespace App\Console\Commands;

use App\Models\Post;
use Illuminate\Console\Command;

class DeletePosts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:posts {--id=} {--user=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete posts by id or by user with all its comments (see options)';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(Post $post)
    {
        $id = $this->option('id');
        $userId = $this->option('user');
        $this->newLine();
        $posts = [];

        if ((empty($id) || $id < 1) && (empty($userId) || $userId < 1)) {
            $this->error('Invalid option(s), it must be an integer > 0');
            return 1;
        } elseif (! empty($id) && $id > 0) {
            $this->info(sprintf('You want to delete post with its comments by id %d', $id));
            $post = Post::find($id);

            if ($post instanceof Post) {
                $posts[] = $post;
            }
        } elseif (! empty($userId) && $userId > 0) {
            $this->info(sprintf('You want to delete post with its comments by user %d', $userId));
            $posts = Post::where('user_id', $userId)
                ->get();
        }

        $bar = $this
            ->output
            ->createProgressBar(count($posts));
        $bar->start();

        foreach ($posts as $post) {
            $postId = $post->id;
            $post->delete();

            $this->call('delete:comments', ['--post' => $postId]);

            $bar->advance();
        }

        $bar->finish();
        $this->newLine();
        $this->info('Delete posts - task completed');
        $this->newLine();

        return 0;
    }
}
