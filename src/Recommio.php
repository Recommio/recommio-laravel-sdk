<?php
/**
 * Created by PhpStorm.
 * User: roboticsexpert
 * Date: 5/14/17
 * Time: 12:26 AM
 */

namespace Roboticsexpert\Recommio;


class Recommio
{


    private $baseUrl;
    private $token;

    public function __construct($baseUrl, $token)
    {
        $this->baseUrl = $baseUrl;
        $this->token = $token;
    }


}
