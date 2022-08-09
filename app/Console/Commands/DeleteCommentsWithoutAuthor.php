<?php

namespace App\Console\Commands;

use App\Models\Comment;
use Illuminate\Console\Command;

class DeleteCommentsWithoutAuthor extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:comments {--user=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deleting Comments without an Author';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(Comment $comment)
    {
        $userId = $this->option('user');

        if (empty($userId) || $userId < 1) {
            $this->error('Invalid option, it must be an integer > 0');
            return 1;
        }

        $comments = Comment::where('user_id', $userId)
            ->get();
        $bar = $this
            ->output
            ->createProgressBar(count($comments));
        $bar->start();

        foreach ($comments as $comments) {
            $comment->delete();
            $bar->advance();
        }

        $bar->finish();
        $this->newLine();

        return 0;
    }
}
