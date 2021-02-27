<?php

namespace Tests\Feature;

use App\Events\EmailCreated;
use App\Listeners\SendEmailAfterCreation;
use Illuminate\Events\CallQueuedListener;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;
use Illuminate\Support\Str;

class SendMailsTest extends TestCase
{
    public function test_user_can_not_send_mails_without_api_token()
    {
        $response = $this->api('POST', 'api/send');

        $response->assertStatus(401);

        $response->assertJsonFragment([
            'message' => 'Api Token is missing, you need to pass [api_token] in your request body',
        ]);
    }

    public function test_user_can_not_send_mails_with_invalid_api_token()
    {
        $response = $this->api('POST', 'api/send', [
            'api_token' => Str::random(20)
        ]);

        $response->assertStatus(401);

        $response->assertJsonFragment([
            'message' => 'Api Token is not valid',
        ]);
    }

    public function test_user_can_not_send_mails_with_invalid_emails()
    {
        $response = $this->api('POST', 'api/send', [
            'api_token' => $this->createToken(),
            'emails' => []
        ]);

        $response->assertJsonValidationErrors([
            'emails',
        ]);

        $response = $this->api('POST', 'api/send', [
            'api_token' => $this->createToken(),
            'emails' => [
                [
                    'email' => 'foo'
                ]
            ]
        ]);

        $response->assertJsonValidationErrors([
            'emails.0.email',
        ]);
    }

    public function test_user_can_not_send_mails_with_invalid_subject()
    {
        $response = $this->api('POST', 'api/send', [
            'api_token' => $this->createToken(),
            'emails' => [
                [
                    'subject' => ''
                ]
            ]
        ]);

        $response->assertJsonValidationErrors([
            'emails.0.subject',
        ]);
    }

    public function test_user_can_not_send_mails_with_invalid_body()
    {
        $response = $this->api('POST', 'api/send', [
            'api_token' => $this->createToken(),
            'emails' => [
                [
                    'body' => ''
                ]
            ]
        ]);

        $response->assertJsonValidationErrors([
            'emails.0.body',
        ]);
    }

    public function test_user_can_send_mails()
    {
        Queue::fake();

        $data = $this->getRequestTemplate('send_mails_request_sample');

        $response = $this->api('POST', 'api/send', array_merge(
            ['api_token' => $this->createToken()], $data
        ));

        $response->assertJsonFragment([
            'message' => sprintf('Sending %d emails ...', count($data['emails']))
        ]);

        Queue::assertPushed(CallQueuedListener::class, function ($job) {
            return $job->class == SendEmailAfterCreation::class;
        });
    }
}
