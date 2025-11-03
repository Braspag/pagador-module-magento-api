<?php

namespace Braspag\BraspagPagador\Gateway\Transaction\Base\Resource;

use Magento\Payment\Gateway\Data\PaymentDataObjectInterface;
use Magento\Payment\Gateway\Request\BuilderInterface;

/**
 * Braspag Transaction Base Request Builder
 *
 * @author      Nexaas Team <dev@nexaas.com>
 * @copyright   2025 Nexaas (http://www.nexxaas.com)
 * @license     http://www.nexaas.com  Copyright
 *
 * @link        http://www.nexaas.com
 */
class RequestBuilder implements BuilderInterface
{
    protected $request;

    public function __construct(
        RequestInterface $request
    ) {
        $this->setRequest($request);
    }

    public function build(array $buildSubject)
    {
        if (!isset($buildSubject['payment']) || !$buildSubject['payment'] instanceof PaymentDataObjectInterface) {
            throw new \InvalidArgumentException('Payment data object should be provided');
        }

        $paymentDataObject = $buildSubject['payment'];
        $orderAdapter = $paymentDataObject->getOrder();
        $paymentData = $paymentDataObject->getPayment();

        $this->getRequest()->setOrderAdapter($orderAdapter);
        $this->getRequest()->setPaymentData($paymentData);

        return $this->getRequest();
    }

    protected function getRequest()
    {
        return $this->request;
    }

    protected function setRequest(RequestInterface $request)
    {
        $this->request = $request;

        return $this;
    }
}