<?php

/**
 * @author      Nexaas Core Team <dev@nexaas.com>
 * @copyright   2025 Nexaas (http://www.nexaas.com)
 * @license     http://www.nexaas.com  Copyright
 *
 * @link        http://www.nexaas.com
 */

namespace Braspag\BraspagPagador\Gateway\Transaction\Base\Resource\PaymentStatus;

use Braspag\BraspagPagador\Gateway\Transaction\Base\Config\Config;

class Request extends Config implements RequestInterface
{
    /**
     * @var string
     */
    protected $paymentId;

    /**
     * @var int
     */
    protected $storeId;

    /**
     * @var string
     */
    protected $additionalRequest;

    public function isTestEnvironment()
    {
        return $this->getIsTestEnvironment();
    }

    /**
     * @inheritDoc
     */
    public function setPaymentId(string $paymentId)
    {
        $this->paymentId = $paymentId;
    }

    /**
     * @inheritDoc
     */
    public function getPaymentId(): string
    {
        return $this->paymentId;
    }

    /**
     * @inheritDoc
     */
    public function setStoreId($storeId = null)
    {
        $this->storeId = $storeId;
    }

    /**
     * @inheritDoc
     */
    public function getStoreId()
    {
        return $this->storeId;
    }

    /**
     * @param string $additionalRequest
     */
    public function setAdditionalRequest(string $additionalRequest)
    {
        $this->additionalRequest = $additionalRequest;
    }

    /**
     * @return string
     */
    public function getAdditionalRequest()
    {
        return $this->additionalRequest;
    }

    /**
     * @return array
     */
    public function getRequestDataBody()
    {
        return [];
    }
}