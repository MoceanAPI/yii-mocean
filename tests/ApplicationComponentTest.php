<?php
/**
 * Created by PhpStorm.
 * User: Neoson Lam
 * Date: 6/24/2019
 * Time: 4:20 PM.
 */

namespace YiiMocean\Tests;

use YiiMocean\MoceanServiceProvider;

class ApplicationComponentTest extends AbstractTesting
{
    public function testWhetherMoceanableResolveFromContainer()
    {
        $mocean = $this->app->mocean;
        $this->assertInstanceOf(MoceanServiceProvider::class, $mocean);
    }
}
