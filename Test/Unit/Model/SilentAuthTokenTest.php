<?php

/**
 *
 * Silent Auth Token Test.php
 *
 * @author      Nexaas Core Team <dev@nexaas.com>
 * @copyright   2025 Nexaas (http://www.nexaas.com)
 * @license     http://www.nexaas.com  Copyright
 *
 * @link        http://www.nexaas.com
 */

namespace Braspag\BraspagPagador\Test\Unit\Model;

use Braspag\BraspagPagador\Model\SilentAuthToken;

class SilentAuthTokenTest extends \PHPUnit\Framework\TestCase
{
    private $model;

    protected function setUp()
    {
        $objectManager = new \Magento\Framework\TestFramework\Unit\Helper\ObjectManager($this);

        $this->builderMock = $this->createMock(\Braspag\BraspagPagador\Gateway\Transaction\Base\Resource\SilentOrderPost\BuilderInterface::class);

        $this->model = $objectManager->getObject(
            SilentAuthToken::class,
            [
                'builder' => $this->builderMock
            ]
        );
    }

    /** @test */
    public function test()
    {
        // prepare the test

        $expected = '123-456-789';

        $this->builderMock->expects($this->once())
            ->method('build')
            ->will($this->returnValue($expected));

        // perform the changes

        $result = $this->model->getToken();

        // test the results

        static::assertEquals($expected, $result);
    }
}