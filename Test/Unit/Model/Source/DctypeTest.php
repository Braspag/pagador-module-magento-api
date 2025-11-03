<?php

/**
 *
 * Boleto Types Test.php
 *
 * @author      Nexaas Core Team <dev@nexaas.com>
 * @copyright   2025 Nexaas (http://www.nexaas.com)
 * @license     http://www.nexaas.com  Copyright
 *
 * @link        http://www.nexaas.com
 */

namespace Braspag\BraspagPagador\Test\Unit\Model\Source;

use Braspag\BraspagPagador\Model\Source\Dctype;

class DctypeTest extends \PHPUnit\Framework\TestCase
{
    private $model;

    protected function setUp()
    {
        $objectManager = new \Magento\Framework\TestFramework\Unit\Helper\ObjectManager($this);

        // mocks

        $this->model = $objectManager->getObject(
            Dctype::class,
            []
        );
    }

    /** @test */
    public function test()
    {
        // prepare the test

        $expected = [
            'Simulado',
            'Cielo-Visa',
            'Cielo-Master',
            'Cielo30-Visa',
            'Cielo30-Master',
            'Cielo30-Elo',
            'Getnet-Visa',
            'Getnet-Master',
            'Rede2-Visa',
            'Rede2-Master',
            'FirstData-Visa',
            'FirstData-Master',
            'GlobalPayments-Visa',
            'GlobalPayments-Master'
        ];

        // perform the changes

        $result = $this->model->getAllowedTypes();

        // test the results

        static::assertEquals($expected, $result);
    }
}