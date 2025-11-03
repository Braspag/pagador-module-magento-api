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

use Braspag\BraspagPagador\Model\Source\VerticalSegment;

class VerticalSegmentTest extends \PHPUnit\Framework\TestCase
{
    private $model;

    protected function setUp()
    {
        $objectManager = new \Magento\Framework\TestFramework\Unit\Helper\ObjectManager($this);

        // mocks

        $this->model = $objectManager->getObject(
            VerticalSegment::class,
            []
        );
    }

    /** @test */
    public function test()
    {
        // prepare the test

        $expected = [
            [
                'value' => 'Retail',
                'label' => __('Retail'),
            ],
            [
                'value' => 'Cosmeticos',
                'label' => __('Cosmeticos')
            ],
            [
                'value' => 'Joalheria',
                'label' => __('Joalheria')
            ],
            [
                'value' => 'DigitalGoods',
                'label' => __('Digital Goods')
            ],
            [
                'value' => 'Servicos',
                'label' => __('Servicos')
            ],
            [
                'value' => 'Turismo',
                'label' => __('Turismo')
            ],
            [
                'value' => 'Generico',
                'label' => __('Generico')
            ]
        ];

        // perform the changes

        $result = $this->model->toOptionArray();

        // test the results

        static::assertEquals($expected, $result);
    }
}