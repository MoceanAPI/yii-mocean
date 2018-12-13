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

    public function using($account)
    {
        if (!isset($this->accounts[$account])) {
            throw new InvalidConfigException("Account \"$account\" is not configured.");
        }
        $settings = $this->accounts[$account];
        return new YiiMocean($settings['apiKey'], $settings['apiSecret'], $settings['from']);
    }

    public function __call($method, $arguments)
    {
        return call_user_func_array([$this->defaultConnection(), $method], $arguments);
    }

    protected function defaultConnection()
    {
        return $this->using($this->defaults);
    }
}
