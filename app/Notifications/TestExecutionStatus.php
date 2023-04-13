<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;

class TestExecutionStatus extends Notification
{
    public array $data;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['slack'];
    }

    /**
     * Get the Slack representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return SlackMessage
     */
    public function toSlack($notifiable)
    {
        return (new SlackMessage)
                ->content('Test execution report!')
                ->attachment(function ($attachment) {
                    $attachment
                        ->fields([
                            'Release' => $this->data['commitMessage'],
                            'Status' => $this->data['status'],
                            'Job Name' => $this->data['jobName'] ?? 'Unit test',
                        ])
                        ->color($this->data['status'] === 'failure' ? '#FF0000' : '#00FF00')
                        ->timestamp(time());
                });
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
