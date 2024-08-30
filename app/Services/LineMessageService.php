<?php

namespace App\Services;

use GuzzleHttp\Client;

class LineMessageService
{
    protected static $httpClient;
    protected static $channelAccessToken;

    public static function initialize()
    {
        self::$httpClient = new Client();
        self::$channelAccessToken = env('LINE_CHANNEL_ACCESS_TOKEN');
    }

    public static function sendMessage($userId, $message)
    {
        // Initialize httpClient and channelAccessToken
        if (is_null(self::$httpClient) || is_null(self::$channelAccessToken)) {
            self::initialize();
        }

        $response = self::$httpClient->post('https://api.line.me/v2/bot/message/push', [
            'headers' => [
                'Authorization' => 'Bearer ' . self::$channelAccessToken,
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'to' => $userId,
                'messages' => [
                    [
                        'type' => 'text',
                        'text' => $message,
                    ]
                ],
            ],
        ]);

        return $response->getStatusCode() === 200;
    }
}