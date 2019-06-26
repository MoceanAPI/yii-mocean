<?php
/**
 * Created by PhpStorm.
 * User: Neoson Lam
 * Date: 6/25/2019
 * Time: 11:09 AM.
 */

namespace YiiMocean\Tests;

use PHPUnit\Framework\TestCase;
use yii\console\Application;
use yii\helpers\ArrayHelper;

class AbstractTesting extends TestCase
{
    /* @var Application $app */
    protected $app;

    protected function setUp()
    {
        if (!defined('YII_ENV')) {
            define('YII_ENV', 'test');
        }
        require_once __DIR__.'/../vendor/yiisoft/yii2/Yii.php';

        $this->app = new Application(ArrayHelper::merge([
            'id'         => 'testapp',
            'basePath'   => __DIR__,
            'vendorPath' => $this->getVendorPath(),
        ], [
            'components' => $this->getMoceanConfig(),
        ]));
    }

    protected function getVendorPath()
    {
        $vendor = dirname(dirname(__DIR__)).'/vendor';
        if (!is_dir($vendor)) {
            $vendor = dirname(dirname(dirname(dirname(__DIR__))));
        }

        return $vendor;
    }

    protected function getMoceanConfig()
    {
        return [
            'mocean' => [
                'class'    => 'YiiMocean\MoceanServiceProvider',
                'defaults' => 'main',
                'accounts' => [
                    'main' => [
                        'api_key'    => 'test_api_key',
                        'api_secret' => 'test_api_secret',
                    ],
                    'backup' => [
                        'api_key'    => 'test_backup_api_key',
                        'api_secret' => 'test_backup_api_secret',
                    ],
                ],
            ],
        ];
    }

    public function getClass($class, $property, $object)
    {
        $reflectionClass = new \ReflectionClass($class);
        $refProperty = $reflectionClass->getProperty($property);
        $refProperty->setAccessible(true);

        return $refProperty->getValue($object);
    }
}
