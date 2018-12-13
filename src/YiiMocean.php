<?php
/**
 * Created by PhpStorm.
 * User: Neoson Lam
 * Date: 12/13/2018
 * Time: 11:24 AM
 */

namespace yiimocean;

use Mocean\Client;
use Mocean\Client\Credentials\Basic;
use yii\base\Component;

class YiiMocean
{
    private $from;

    /** @var \Mocean\Client $moceanClient */
    protected $moceanClient;

    /**
     * YiiMocean constructor.
     */
    public function __construct($apiKey, $apiSecret, $from)
    {
        $this->from = $from;
        $credentials = new Basic($apiKey, $apiSecret);
        $this->moceanClient = new Client($credentials);
    }

    /**
     * @param $to
     * @param $text
     * @param array $params
     *
     * @link http://moceanapi.com/docs/#send-sms Documentation
     *
     * @return string
     * @throws Client\Exception\Exception
     */
    public function message($to, $text, array $params = [])
    {
        $params['mocean-to'] = $to;
        $params['mocean-text'] = $text;
        $params['mocean-resp-format'] = 'json';

        if (!isset($params['mocean-from'])) {
            $params['mocean-from'] = $this->from;
        }

        return $this->moceanClient->message()->send($params);
    }

    /**
     * Get the configured mocean sdk
     * @return \Mocean\Client
     */
    public function getMocean()
    {
        return $this->moceanClient;
    }
}
