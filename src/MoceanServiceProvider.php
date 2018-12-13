<?php
/**
 * Created by PhpStorm.
 * User: Neoson Lam
 * Date: 12/13/2018
 * Time: 3:21 PM
 */

namespace yiimocean;

use yii\base\Component;
use yii\base\InvalidConfigException;

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
        if (!isset($this->accounts[$account])) {
            throw new InvalidConfigException("Account \"$account\" is not configured.");
        }
        $settings = $this->accounts[$account];
        return new YiiMocean($settings['apiKey'], $settings['apiSecret'], $settings['from']);
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
