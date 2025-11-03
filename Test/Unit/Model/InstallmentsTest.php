<?php

/**
 *
 * Installments Test.php
 *
 * @author      Nexaas Core Team <dev@nexaas.com>
 * @copyright   2025 Nexaas (http://www.nexaas.com)
 * @license     http://www.nexaas.com  Copyright
 *
 * @link        http://www.nexaas.com
 */

namespace Braspag\BraspagPagador\Test\Unit\Model;

use Braspag\BraspagPagador\Model\Installments;

class InstallmentsTest extends \PHPUnit\Framework\TestCase
{
    private $model;

    protected function setUp()
    {
        $objectManager = new \Magento\Framework\TestFramework\Unit\Helper\ObjectManager($this);
        $this->builderMock = $this->createMock(\Braspag\BraspagPagador\Gateway\Transaction\Base\Resource\Installments\BuilderInterface::class);
        $this->InstallmentMock = $this->createMock(\Braspag\BraspagPagador\Gateway\Transaction\Base\Resource\Installments\InstallmentInterface::class);

        $this->model = $objectManager->getObject(
            Installments::class,
            [
                'builder' => $this->builderMock
            ]
        );
    }

    /** @test */
    public function test()
    {
        // prepare the test

        $id = 1;
        $label = 'label';

        $this->InstallmentMock->expects($this->once())
            ->method('getId')
            ->will($this->returnValue($id));

        $this->InstallmentMock->expects($this->once())
            ->method('getLabel')
            ->will($this->returnValue($label));

        $expected = [
            ['id' => $id, 'label' => $label]
        ];



        $this->builderMock->expects($this->once())
            ->method('build')
            ->will($this->returnValue([$this->InstallmentMock]));

        // perform the changes

        $result = $this->model->getInstallments();

        // test the results

        static::assertEquals($expected, $result);
    }
}