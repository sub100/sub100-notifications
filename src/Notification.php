<?php

namespace sub100\Notifications;

use GuzzleHttp\Client;

class Notification
{
    private string $notificationApiUrl;

    public function __construct(string $notificationApiUrl)
    {
        $this->notificationApiUrl = trim($notificationApiUrl, '/') . '/';
    }

    public function notify(Message $message, string $token = ''): bool
    {
        $client = $this->getClient($token);
        $response = $client->post('notify', [
            'body' => $message->toJson()
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }

    public function historyByOrigin(string $originId, string $token = '')
    {
        $client = $this->getClient($token);
        $response = $client->post('notification/history/all-by-origin', [
            'body' => ['origin_id' => $originId]
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }

    public function historyByClientAndOrigin(array $clientIds, string $originId, string $token = '')
    {
        $client = $this->getClient($token);
        $response = $client->post('notification/history/all-by-client-and-origin', [
            'body' => ['origin_id' => $originId, 'client_id' => $clientIds]
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }

    public function historyByNotificationAndOrigin(array $notificationIds, string $originId, string $token = '')
    {
        $client = $this->getClient($token);
        $response = $client->post('notification/history/all-by-notification-and-origin', [
            'body' => ['origin_id' => $originId, 'notification_ids' => $notificationIds]
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }

    private function getClient(string $token = '')
    {
        return new Client([
            'base_uri' => $this->notificationApiUrl,
            'headers' => [
                'content-type' => 'application/json',
                'Accept' => 'application/json',
                'x-api-key' => $token ?: request()->header('x-api-key'),
            ]
        ]);
    }
}
