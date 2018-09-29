<?php
/**
 * Created by PhpStorm.
 * User: roboticsexpert
 * Date: 5/14/17
 * Time: 12:26 AM
 */

namespace Roboticsexpert\Recommio;


use GuzzleHttp\Client;

class RecommioGraph
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

    public function sendDetailView(string $user, string $item)
    {
        $response = $this->request('events/detailView', compact('item', 'user'));
        return $response != false;
    }

    public function sendPurchase(string $user, string $item)
    {
        $response = $this->request('events/purchase', compact('item', 'user'));
        return $response != false;
    }

    public function sendBookmark(string $user, string $item)
    {
        $response = $this->request('events/bookmark', compact('item', 'user'));
        return $response != false;
    }

    public function sendRate(string $user, string $item, float $rate)
    {
        $response = $this->request('events/rate', compact('item', 'user','rate'));
        return $response != false;
    }

    public function sendCart(string $user, string $item)
    {
        $response = $this->request('events/cart', compact('item', 'user'));
        return $response != false;
    }


}
