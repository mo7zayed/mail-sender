<?php

namespace App\Events;

use App\Models\SentMails;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class EmailCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public SentMails $sent_mail;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(SentMails $sent_mail)
    {
        $this->sent_mail = $sent_mail;
    }
}
