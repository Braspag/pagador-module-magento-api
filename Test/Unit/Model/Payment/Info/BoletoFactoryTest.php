<?php

/**
 * @author      Nexaas Team <dev@nexaas.com>
 * @copyright   2025 Nexaas (http://www.nexxaas.com)
 * @license     http://www.nexaas.com  Copyright
 *
 * @link        http://www.nexaas.com
 *
 */

namespace Braspag\BraspagPagador\Test\Unit\Model\Payment\Info;

use Braspag\BraspagPagador\Model\Payment\Info\Boleto;
use Braspag\BraspagPagador\Model\Payment\Info\BoletoFactory;
use Magento\Sales\Api\Data\OrderInterface;
use Magento\Framework\ObjectManagerInterface;

class BoletoFactoryTest extends \PHPUnit\Framework\TestCase
{
    private $boletoFactory;
    private $orderMock;

    public function setUp()
    {
        $this->orderMock = $this->getMockBuilder(OrderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();
    }

    public function testCreate()
    {
        $this->boletoFactory = new BoletoFactory();

        $this->assertInstanceOf(Boleto::class, $this->boletoFactory->create($this->orderMock));
    }
}
