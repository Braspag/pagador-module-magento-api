<?php

namespace Braspag\BraspagPagador\Model\Source;

use Magento\Framework\Option\ArrayInterface;

/**
 * CC Types
 *
 * @author      Nexaas Team <dev@nexaas.com>
 * @copyright   2025 Nexaas (http://www.nexxaas.com)
 * @license     http://www.nexaas.com  Copyright
 *
 * @link        http://www.nexaas.com
 */

class PaymentSplitMdrTypes implements ArrayInterface
{
    const PAYMENT_SPLIT_MDR_TYPE_UNIQUE = 1;
    const PAYMENT_SPLIT_MDR_TYPE_MULTIPLE = 2;
    /**
     * @return array
     */
    public function toOptionArray()
    {
        return [
            [
                'value' => self::PAYMENT_SPLIT_MDR_TYPE_UNIQUE,
                'label' => __('Unique'),
            ],
            [
                'value' => self::PAYMENT_SPLIT_MDR_TYPE_MULTIPLE,
                'label' => __('Multiple')
            ]
        ];
    }
}