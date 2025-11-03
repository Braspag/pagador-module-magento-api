<?php

namespace Braspag\BraspagPagador\Gateway\Transaction\PaymentSplit\Resource\Lock;

use Magento\Sales\Api\Data\OrderInterface;
use Magento\Payment\Gateway\Request\BuilderInterface;
use Braspag\BraspagPagador\Gateway\Transaction\Base\Config\ConfigInterface;
use Braspag\BraspagPagador\Api\Transaction\Api\PaymentSplit\Lock\RequestInterface;

/**
 * Braspag Transaction Boleto Send Request Builder
 *
 * @author      Nexaas Team <dev@nexaas.com>
 * @copyright   2020 Webjump (http://www.nexaas.com)
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

        if (empty($buildSubject['subordinates'])) {
            throw new \InvalidArgumentException('Subordinate data should be provided');
        }

        $this->getRequest()->setOrder($buildSubject['order']);
        $this->getRequest()->setIsLocked($buildSubject['locked']);
        $this->getRequest()->setSubordinates($buildSubject['subordinates']);
        $this->getRequest()->setConfig($this->getConfig());

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