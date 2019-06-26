<?php
/**
 * Created by PhpStorm.
 * User: Neoson Lam
 * Date: 6/24/2019
 * Time: 3:21 PM.
 */

namespace YiiMocean\Tests;

class ApiTest extends AbstractTesting
{
    public function testBasicCredentialCreatedObject()
    {
        $mocean = $this->app->mocean;
        $crendentialObject = $this->getClass(\Mocean\Client::class, 'credentials', $mocean->getMocean());
        $crendentialData = $this->getClass(\Mocean\Client\Credentials\Basic::class, 'credentials', $crendentialObject);

        $this->assertInstanceOf(\Mocean\Client\Credentials\Basic::class, $crendentialObject);
        $this->assertEquals(['mocean-api-key' => 'test_api_key', 'mocean-api-secret' => 'test_api_secret'], $crendentialData);
    }

    public function testUsingDifferentAccount()
    {
        $mocean = $this->app->mocean;
        $crendentialObject = $this->getClass(\Mocean\Client::class, 'credentials', $mocean->using('backup')->getMocean());
        $crendentialData = $this->getClass(\Mocean\Client\Credentials\Basic::class, 'credentials', $crendentialObject);

        $this->assertInstanceOf(\Mocean\Client\Credentials\Basic::class, $crendentialObject);
        $this->assertEquals(['mocean-api-key' => 'test_backup_api_key', 'mocean-api-secret' => 'test_backup_api_secret'], $crendentialData);
    }

    public function testUsingBasicCrendetialAccount()
    {
        $mocean = $this->app->mocean;
        $basicCrendentials = new \Mocean\Client\Credentials\Basic('test_basic_key', 'test_basic_secret');

        $crendentialObject = $this->getClass(\Mocean\Client::class, 'credentials', $mocean->using($basicCrendentials)->getMocean());
        $crendentialData = $this->getClass(\Mocean\Client\Credentials\Basic::class, 'credentials', $crendentialObject);

        $this->assertInstanceOf(\Mocean\Client\Credentials\Basic::class, $crendentialObject);
        $this->assertEquals(['mocean-api-key' => 'test_basic_key', 'mocean-api-secret' => 'test_basic_secret'], $crendentialData);
    }

    public function testUsingArrayAccount()
    {
        $mocean = $this->app->mocean;
        $crendentials = [
            'api_key'    => 'test_array_key',
            'api_secret' => 'test_array_secret',
        ];

        $crendentialObject = $this->getClass(\Mocean\Client::class, 'credentials', $mocean->using($crendentials)->getMocean());
        $crendentialData = $this->getClass(\Mocean\Client\Credentials\Basic::class, 'credentials', $crendentialObject);

        $this->assertInstanceOf(\Mocean\Client\Credentials\Basic::class, $crendentialObject);
        $this->assertEquals(['mocean-api-key' => 'test_array_key', 'mocean-api-secret' => 'test_array_secret'], $crendentialData);
    }
}
