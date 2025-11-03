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

class PaymentSplitType implements ArrayInterface
{
    const PAYMENT_SPLIT_TYPE_TRANSACTIONAL = 'transactional';
    const PAYMENT_SPLIT_TYPE_TRANSACTIONAL_POST = 'transactional-post';
    /**
     * @return array
     */
    public function toOptionArray()
    {
        return [
            [
                'value' => self::PAYMENT_SPLIT_TYPE_TRANSACTIONAL,
                'label' => __('Transactional'),
            ],
            [
                'value' => self::PAYMENT_SPLIT_TYPE_TRANSACTIONAL_POST,
                'label' => __('Transactional Post')
            ]
        ];
    }
}