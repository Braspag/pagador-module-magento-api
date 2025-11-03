<?php

namespace Braspag\BraspagPagador\Model\Source;

use Magento\Framework\Option\ArrayInterface;

/**
 * Cielo Versions
 *
 * @author      Nexaas Team <dev@nexaas.com>
 * @copyright   2025 Nexaas (http://www.nexxaas.com)
 * @license     http://www.nexaas.com  Copyright
 *
 * @link        http://www.nexaas.com
 */

class CieloVersion implements ArrayInterface
{
    /**
     * @return array
     */
    public function toOptionArray()
    {
        return [
            [
                'value' => '1.5',
                'label' => __('Cielo 1.5'),
            ],
            [
                'value' => '3.0',
                'label' => __('Cielo 3.0')
            ]
        ];
    }
}