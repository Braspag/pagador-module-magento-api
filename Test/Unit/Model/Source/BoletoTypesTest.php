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

use Braspag\BraspagPagador\Model\Source\BoletoTypes;

class BoletoTypesTest extends \PHPUnit\Framework\TestCase
{
    private $model;

    protected function setUp()
    {
        $objectManager = new \Magento\Framework\TestFramework\Unit\Helper\ObjectManager($this);

        // mocks

        $this->model = $objectManager->getObject(
            BoletoTypes::class,
            []
        );
    }

    /** @test */
    public function test()
    {
        // prepare the test

        $expected = [
            "Simulado",
            "BancoDoBrasil2",
            "Bradesco2",
            "Braspag",
            "Caixa2",
            "Citibank2",
            "Itau3",
            "Santander2"
        ];

        // perform the changes

        $result = $this->model->getAllowedTypes();

        // test the results

        static::assertEquals($expected, $result);
    }
}