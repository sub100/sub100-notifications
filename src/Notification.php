<?php

namespace sub100\Notifications;

use GuzzleHttp\Client;

class Notification
{
    private string $notificationUrl;

    public function __construct()
    {
        $this->notificationUrl = config('sub100.notification_url');
    }

    public function notify(Message $message, string $token = ''): bool
    {
        $client = $this->getClient($token);
        $response = $client->post('notify', [
            'body' => $message->toJson()
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }

    private function getClient(string $token = '')
    {
        return new Client([
            'base_uri' => $this->notificationUrl,
            'headers' => [
                'content-type' => 'application/json',
                'Accept' => 'application/json',
                'x-api-key' => $token ?: request()->header('x-api-key'),
            ]
        ]);
    }
}
