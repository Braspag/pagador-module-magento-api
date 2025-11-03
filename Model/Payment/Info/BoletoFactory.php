<?php

/**
 * @author      Nexaas Team <dev@nexaas.com>
 * @copyright   2025 Nexaas (http://www.nexxaas.com)
 * @license     http://www.nexaas.com  Copyright
 *
 * @link        http://www.nexaas.com
 *
 */

namespace Braspag\BraspagPagador\Model\Payment\Info;

use Magento\Sales\Api\Data\OrderInterface;

class BoletoFactory implements BoletoFactoryInterface
{
    /**
     * @param OrderInterface $order
     * @return Boleto
     */
    public function create(OrderInterface $order)
    {
        return new Boleto($order);
    }
}