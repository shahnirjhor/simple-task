<?php

namespace App\Console\Commands;

use App\Jobs\AfterPublishPostJob;
use App\Models\Post;
use Illuminate\Console\Command;

class DailyMessage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:daily-message';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command Rakib Scheduler';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $laterCampaigns = Post::where('schedule_type', 'later')->where('post_status', 'Pending')->whereDate('schedule_time', '<=', date('Y-m-d'))->get();
        foreach ($laterCampaigns as $laterCampaign) {

            $now = date('Y-m-d H:i:s');
            if (strtotime($laterCampaign->schedule_time) < strtotime($now)) {
                $laterCampaign->update(['post_status' => 'Published']);
                return true;
            }
        }
    }
}
