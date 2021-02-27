<?php

namespace App\Listeners;

use App\Mail\SendMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendEmailAfterCreation implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        Mail::to($event->sent_mail->email)->send(new SendMail($event->sent_mail));
    }
}
