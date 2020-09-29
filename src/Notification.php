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

    public function notify(Message $message): bool
    {
        $client = $this->getClient();
        $response = $client->post('notify', [
            'body' => $message->toJson()
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }

    private function getClient()
    {
        return new Client([
            'base_uri' => $this->notificationUrl,
            'headers' => [
                'content-type' => 'application/json',
                'Accept' => 'application/json',
                'x-api-key' => request()->header('x-api-key'),
            ]
        ]);
    }
}
