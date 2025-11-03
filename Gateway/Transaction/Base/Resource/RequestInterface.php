<?php

namespace Braspag\BraspagPagador\Gateway\Transaction\Base\Resource;

use Magento\Payment\Gateway\Data\OrderAdapterInterface;
use Magento\Payment\Model\InfoInterface;

/**
 * Braspag Transaction Base Request Interface
 *
 * @author      Nexaas Team <dev@nexaas.com>
 * @copyright   2025 Nexaas (http://www.nexxaas.com)
 * @license     http://www.nexaas.com  Copyright
 *
 * @link        http://www.nexaas.com
 */
interface RequestInterface
{
    public function setOrderAdapter(OrderAdapterInterface $order);

    public function setPaymentData(InfoInterface $payment);
}