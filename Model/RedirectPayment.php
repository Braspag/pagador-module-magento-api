<?php

namespace Braspag\BraspagPagador\Model;

use Magento\Sales\Api\OrderRepositoryInterface;
use Braspag\BraspagPagador\Api\RedirectPaymentInterface;
use Magento\Framework\DataObject;

/**
 *
 *
 * @author      Nexaas Team <dev@nexaas.com>
 * @copyright   2025 Nexaas (http://www.nexxaas.com)
 * @license     http://www.nexaas.com  Copyright
 *
 * @link        http://www.nexaas.com
 */
class RedirectPayment implements RedirectPaymentInterface
{
    protected $OrderRepository;

    public function __construct(
        OrderRepositoryInterface $OrderRepository
    ) {
        $this->setOrderRepository($OrderRepository);
    }

    public function getLink($orderId)
    {
        $order = $this->getOrderRepository()->get((int) $orderId);
        $orderPayment = $order->getPayment();

        $additionalInformation = $orderPayment->getAdditionalInformation();
        if (!is_object($additionalInformation)) {
            $additionalInformation = new DataObject($additionalInformation ?: []);
        }

        return $additionalInformation->getRedirectUrl();
    }


    /**
     * @return OrderRepositoryInterface
     */
    protected function getOrderRepository()
    {
        return $this->OrderRepository;
    }

    protected function setOrderRepository($OrderRepository)
    {
        $this->OrderRepository = $OrderRepository;

        return $this;
    }
}