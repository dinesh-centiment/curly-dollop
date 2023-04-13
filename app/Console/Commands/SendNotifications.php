<?php

namespace App\Console\Commands;

use App\Notifications\TestExecutionStatus;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;

class SendNotifications extends Command
{
    protected $signature = 'app:send-notifications {status} {commitMessage}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $data = [];
        $data['status'] = $this->argument('status');
        $data['commitMessage'] = $this->argument('commitMessage');
        Notification::route('slack', config('slack_webhook.test_execution_callback'))
            ->notifyNow(new TestExecutionStatus($data));
    }
}
