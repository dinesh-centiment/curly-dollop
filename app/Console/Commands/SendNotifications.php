<?php

namespace App\Console\Commands;

use App\Notifications\TestExecutionStatus;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;

class SendNotifications extends Command
{
    protected $signature = 'app:send-notifications {results}';

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
        $data = json_decode($this->argument('results'), true);
        Notification::route('slack', self::$callback)
            ->notifyNow(new TestExecutionStatus($data));
    }
}
