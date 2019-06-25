<?php
/**
 * Created by PhpStorm.
 * User: Neoson Lam
 * Date: 12/31/2018
 * Time: 11:29 AM.
 */

namespace YiiMocean\Tests;

class NoConfigurationTest extends AbstractTesting
{
    public function setUp()
    {
        parent::setUp();

        $config = $this->getMoceanConfig();
        $config['mocean']['accounts']['main']['api_key'] = '';

        $this->app->setComponents($config);
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage api_key is not configured
     */
    public function testExceptionRaisedIfSettingNotConfigured()
    {
        $this->app->mocean->getMocean();
    }
}
