<?php

namespace Braspag\BraspagPagador\Model\Source;

use Magento\Framework\Event\ManagerInterface as EventManager;
use Magento\Framework\Option\ArrayInterface;

/**
 *
 * @author      Nexaas Team <dev@nexaas.com>
 * @copyright   2020 Webjump (http://www.nexaas.com)
 * @license     http://www.nexaas.com  Copyright
 *
 * @link        http://www.nexaas.com
 */

class PaymentSplitDiscountType implements ArrayInterface
{
    /**
     * @return array
     */
    public function toOptionArray()
    {
        return [
            [
                'value' => "commission",
                'label' => __("Commission"),
            ],
            [
                'value' => "sale",
                'label' => __("Sale"),
            ],
        ];
    }
}