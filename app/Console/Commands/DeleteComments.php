<?php

namespace App\Console\Commands;

use App\Models\Comment;
use Illuminate\Console\Command;

class DeleteComments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:comments {--user=} {--post=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete comments by user or by post (see options)';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(Comment $comment)
    {
        $userId = $this->option('user');
        $postId = $this->option('post');
        $this->newLine(2);
        $comments = [];

        if ((empty($userId) || $userId < 1) && (empty($postId) || $postId < 1)) {
            $this->error('Invalid option(s), it must be an integer > 0');

            return 1;
        } elseif (! empty($userId) && $userId > 0  && (empty($postId) || $postId < 1)) {
            $this->info(sprintf('You want to delete comments by user %d', $userId));
            $comments = Comment::where('user_id', $userId)
                ->get();
        } elseif (! empty($postId) && $postId > 0 && (empty($userId) || $userId < 1)) {
            $this->info(sprintf('You want to delete comments by post %d', $postId));
            $comments = Comment::where('post_id', $postId)
                ->get();
        } else {
            $this->info(sprintf('You want to delete comments by user %d and post %d', $userId, $postId));
            $comments = Comment::where('user_id', $userId)
                ->where('post_id', $postId)
                ->get();
        }

        $bar = $this
            ->output
            ->createProgressBar(count($comments));
        $bar->start();

        foreach ($comments as $comment) {
            $comment->delete();
            $bar->advance();
        }

        $bar->finish();
        $this->newLine();
        $this->info('Delete comments - task completed');
        $this->newLine();

        return 0;
    }
}
