<?php

namespace Braspag\BraspagPagador\Model\Source;

use Magento\Framework\Event\ManagerInterface as EventManager;
use Magento\Framework\Option\ArrayInterface;

/**
 * CC Types
 *
 * @author      Nexaas Team <dev@nexaas.com>
 * @copyright   2020 Webjump (http://www.nexaas.com)
 * @license     http://www.nexaas.com  Copyright
 *
 * @link        http://www.nexaas.com
 */

class PaymentSplitMarketplaceVendor implements ArrayInterface
{
    /**
     * @var EventManager
     */
    protected $eventManager;

    public function __construct(
        EventManager $eventManager
    ) {
        $this->eventManager = $eventManager;
    }

    /**
     * @return array
     */
    public function toOptionArray()
    {
        return [
            [
            'value' => "braspag",
            'label' => __("Braspag"),
            ]
        ];
    }
}