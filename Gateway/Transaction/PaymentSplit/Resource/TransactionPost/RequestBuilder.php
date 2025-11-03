<?php

namespace Braspag\BraspagPagador\Gateway\Transaction\PaymentSplit\Resource\TransactionPost;

use Magento\Sales\Api\Data\OrderInterface;
use Braspag\BraspagPagador\Gateway\Transaction\CreditCard\Config\ConfigInterface;
use Magento\Payment\Gateway\Request\BuilderInterface;
use Braspag\BraspagPagador\Gateway\Transaction\PaymentSplit\Resource\TransactionPost\RequestFactory;
use Braspag\BraspagPagador\Model\Source\PaymentSplitType;
use Braspag\BraspagPagador\Api\Transaction\Api\PaymentSplit\RequestInterface;

/**
 * Braspag Transaction Boleto Send Request Builder
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
    protected $config;

    public function __construct(
        RequestInterface $request,
        ConfigInterface $config
    ) {
        $this->setRequest($request);
        $this->setConfig($config);
    }

    public function build(array $buildSubject)
    {
        if (!isset($buildSubject['order']) || !$buildSubject['order'] instanceof OrderInterface) {
            throw new \InvalidArgumentException('Order data object should be provided');
        }

        if (
            $this->getConfig()->isPaymentSplitActive()
            && $this->getConfig()->getPaymentSplitType() == PaymentSplitType::PAYMENT_SPLIT_TYPE_TRANSACTIONAL_POST
        ) {
            $this->getRequest()->setConfig($this->getConfig());
            $this->getRequest()->setOrder($buildSubject['order']);
        }

        return $this->getRequest();
    }

    /**
     * @return mixed
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @param mixed $request
     */
    public function setRequest($request)
    {
        $this->request = $request;
    }

    protected function setConfig(ConfigInterface $config)
    {
        $this->config = $config;
        return $this;
    }

    protected function getConfig()
    {
        return $this->config;
    }
}