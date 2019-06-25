<?php
/**
 * Created by PhpStorm.
 * User: Neoson Lam
 * Date: 12/13/2018
 * Time: 11:24 AM
 */

namespace YiiMocean;

use Mocean\Client;
use Mocean\Client\Credentials\Basic;

/**
 * @mixin Client
 */
class YiiMocean
{
    /** @var \Mocean\Client $moceanClient */
    protected $moceanClient;

    /**
     * YiiMocean constructor.
     */
    public function __construct($apiKey, $apiSecret)
    {
        $credentials = new Basic($apiKey, $apiSecret);
        $this->moceanClient = new Client($credentials);
    }

    /**
     * Get the configured mocean sdk
     * @return \Mocean\Client
     */
    public function getMocean()
    {
        return $this->moceanClient;
    }

    public function __call($method, $arguments)
    {
        return call_user_func_array([$this->getMocean(), $method], $arguments);
    }
}
