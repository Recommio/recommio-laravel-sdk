<?php
/**
 * Created by PhpStorm.
 * User: roboticsexpert
 * Date: 5/14/17
 * Time: 12:26 AM
 */

namespace Roboticsexpert\Recommio;


use GuzzleHttp\Client;

class Recommio
{


    private $baseUrl;
    private $token;
    private $client;

    public function __construct($baseUrl, $token)
    {
        $this->baseUrl = $baseUrl;
        $this->token = $token;
        $this->client = new Client(['base_url' => $this->baseUrl, 'verify' => false]);
    }

    private function request($uri, $body)
    {
        try {
            return $this->client->post($this->baseUrl . $uri, [
                'headers' => [
                    'Authorization' => 'Basic ' . $this->token,

                ],
                'body' => json_encode($body)
            ]);
        } catch (\Exception $exception) {

        }
        return false;
    }

    public function sendEvent(string $user, string $item, $action)
    {
        $response = $this->request('events', compact('item', 'user', 'action'));
        return true;

    }

    public function recommendByUser(string $user, array $actions, array $excludedActions)
    {
        $response = $this->request('recommendByUser', compact('user', 'actions', 'excludedActions'));

        return \GuzzleHttp\json_decode((string)$response->getBody());
    }

    public function recommendByّItem(string $item, array $actions, array $excludedActions)
    {
        $response = $this->request('recommendByItem', compact('item', 'actions', 'excludedActions'));

        return \GuzzleHttp\json_decode((string)$response->getBody());
    }


}
