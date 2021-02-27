<?php

namespace App\Http\Controllers\Mails;

use App\Events\EmailCreated;
use App\Http\Controllers\Controller;
use App\Http\Requests\Mails\SendEmailsRequest;
use App\Models\SentMails;

class SendEmails extends Controller
{
    public function __invoke(SendEmailsRequest $request)
    {
        $data = $request->validated();

        foreach ($data['emails'] as $mail) {
            $sent_mail = SentMails::create([
                'email' => $mail['email'],
                'subject' => $mail['subject'],
                'body' => $mail['body']
            ]);

            foreach ($mail['attachments'] as $attachment) {
                $sent_mail->addMediaFromBase64($attachment['base64'])->usingFileName($attachment['name'])->toMediaCollection('attachments');
            }

            event(new EmailCreated($sent_mail));
        }

        return response()->json([
            'message' => sprintf('Sending %d emails ...', count($data['emails'])),
            'success' => true
        ]);
    }
}
