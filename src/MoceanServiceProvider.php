<?php
/**
 * Created by PhpStorm.
 * User: Neoson Lam
 * Date: 12/13/2018
 * Time: 3:21 PM
 */

namespace YiiMocean;

use InvalidArgumentException;
use Mocean\Client\Credentials\Basic;
use yii\base\Component;

class MoceanServiceProvider extends Component
{
    public $defaults;
    public $accounts;

    /**
     * abilitity to switch account defined in config
     *
     * @param $account
     * @return YiiMocean
     */
    public function using($account)
    {
        if (is_array($account)) {
            $settings = $account;
        } elseif ($account instanceof Basic) {
            $settings = [
                'api_key' => $account['mocean-api-key'],
                'api_secret' => $account['mocean-api-secret'],
            ];
        } else {
            if (!isset($this->accounts[$account])) {
                throw new InvalidArgumentException("Account \"$account\" is not configured.");
            }

            $settings = $this->accounts[$account];
        }

        if (!isset($settings['api_key']) || $settings['api_key'] === '') {
            throw new InvalidArgumentException('api_key is not configured');
        }

        if (!isset($settings['api_secret']) || $settings['api_secret'] === '') {
            throw new InvalidArgumentException('api_secret is not configured');
        }

        return new YiiMocean($settings['api_key'], $settings['api_secret']);
    }

    /**
     * Magically call function defined in YiiMocean Class
     * @param $method
     * @param $arguments
     * @return mixed
     */
    public function __call($method, $arguments)
    {
        return call_user_func_array([$this->defaultConnection(), $method], $arguments);
    }

    /**
     * this will be called to use default connections
     * @return YiiMocean
     */
    protected function defaultConnection()
    {
        return $this->using($this->defaults);
    }
}
