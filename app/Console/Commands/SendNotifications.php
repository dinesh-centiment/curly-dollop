<?php

namespace App\Console\Commands;

use App\Notifications\TestExecutionStatus;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;

class SendNotifications extends Command
{
    protected $signature = 'app:send-notifications {status} {commitMessage}';

    private static $callback = 'https://hooks.slack.com/services/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';

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
        Notification::route('slack', self::$callback)
            ->notifyNow(new TestExecutionStatus($data));
    }
}
