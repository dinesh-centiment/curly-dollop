<?php

namespace App\Console\Commands;

use App\Notifications\TestExecutionStatus;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;

class SendNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-notifications {job}';

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
        $data = json_decode($this->argument('job'), true) ?? [];
        Notification::route('slack', config('slack_webhook.test_execution_callback'))
            ->notifyNow(new TestExecutionStatus($data));
    }
}
