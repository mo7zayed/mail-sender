<?php

namespace App\Mail;

use App\Models\SentMails;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    public SentMails $sent_mail;

    /**
     * Create a new mail instance.
     *
     * @return void
     */
    public function __construct(SentMails $sent_mail)
    {
        $this->sent_mail = $sent_mail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $email = $this->from('mail@app.com')
            ->subject($this->sent_mail->subject)
            ->markdown('mails.mail', [
                'body' => $this->sent_mail->body,
            ]);

        foreach ($this->sent_mail->getMedia('attachments') as $attachment) {
            $email->attach($attachment->getPath(), [
                'as' => $attachment->file_name
            ]);
        }

        return $email;
    }
}
