<?php

namespace App\Console;

use App\Jobs\AfterPublishPostJob;
use App\Models\Post;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('app:daily-message')
            ->everyMinute();



        $posts = Post::with('user')->where('post_status', 'Published')->where('email_status', 'Pending')->get();
        foreach ($posts as $post) {
            $schedule->job(new AfterPublishPostJob($post))->when(function () use ($post) {
                $post->update(['email_status' => 'Processing']);
                return true;
            });
        }
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
