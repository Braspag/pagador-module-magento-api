<?php

namespace Braspag\BraspagPagador\Gateway\Transaction\Boleto\Resource\Send;

use Braspag\BraspagPagador\Gateway\Transaction\Base\Resource\Send\Request as BaseRequest;
use Braspag\BraspagPagador\Gateway\Transaction\Boleto\Resource\Send\RequestInterface as BraspagMagentoRequestInterface;
use Braspag\BraspagPagador\Gateway\Transaction\Boleto\Config\ConfigInterface;
use Braspag\BraspagPagador\Api\Transaction\Api\Boleto\Send\RequestInterface as BraspaglibRequestInterface;
use Braspag\BraspagPagador\Api\Transaction\Api\PaymentSplit\RequestInterface as RequestPaymentSplitLibInterface;
use Magento\Payment\Gateway\Data\PaymentDataObjectInterface;
use Magento\Payment\Model\InfoInterface;
use Magento\Payment\Gateway\Data\OrderAdapterInterface;
use Braspag\BraspagPagador\Helper\Validator;

/**
 * Braspag Transaction Boleto Send Request
 *
 * @author      Nexaas Team <dev@nexaas.com>
 * @copyright   2025 Nexaas (http://www.nexxaas.com)
 * @license     http://www.nexaas.com  Copyright
 *
 * @link        http://www.nexaas.com
 */
class Request extends BaseRequest  implements BraspagMagentoRequestInterface, BraspaglibRequestInterface
{
    /**
     * @var
     */
    protected $orderAdapter;
    /**
     * @var
     */
    protected $quote;
    /**
     * @var
     */
    protected $config;
    /**
     * @var
     */
    protected $billingAddress;
    /**
     * Helper validator.
     *
     * @var Validator
     */
    protected $validator;

    protected $helperData;

    /**
     * @var
     */
    protected $paymentSplitRequest;

    /**
     * @var
     */
    protected $antiFraudRequest;

    /**
     * @var
     */
    protected $paymentData;

    /**
     * @var
     */
    protected $order;



    /**
     * Request constructor.
     *
     * @param ConfigInterface $config
     * @param Validator $validator
     */
    public function __construct(
        ConfigInterface $config,
        Validator $validator,
        \Braspag\BraspagPagador\Helper\Data $helperData
    ) {
        $this->setConfig($config);
        $this->validator = $validator;
        $this->helperData = $helperData;
    }


    /**
     * @return \Magento\Quote\Model\Quote
     */
    protected function getQuote()
    {
        if (!$this->quote) {
            $this->quote = $this->getConfig()->getSession()->getQuote();
        }

        return $this->quote;
    }


    /**
     * @return mixed
     */
    public function getPaymentProvider()
    {
        return $this->getConfig()->getPaymentProvider();
    }

    /**
     * @return mixed
     */
    public function getPaymentBank()
    {
        return $this->getConfig()->getPaymentBank();
    }

    /**
     * @return string
     */
    public function getPaymentAddress()
    {
        return $this->getConfig()->getPaymentAssignorAddress();
    }


    /**
     * @return mixed
     */
    public function getPaymentBoletoNumber()
    {
        return $this->getOrderAdapter()->getOrderIncrementId();
    }

    /**
     * @return mixed
     */
    public function getPaymentAssignor()
    {
        return $this->getConfig()->getPaymentAssignor();
    }

    /**
     * @return mixed
     */
    public function getPaymentDemonstrative()
    {
        return $this->getConfig()->getPaymentDemonstrative();
    }

    /**
     * @return mixed
     */
    public function getPaymentExpirationDate()
    {
        return $this->getConfig()->getExpirationDate();
    }

    /**
     * @return mixed
     */
    public function getPaymentIdentification()
    {
        return $this->getConfig()->getPaymentIdentification();
    }

    /**
     * @return mixed
     */
    public function getPaymentInstructions()
    {
        return $this->getConfig()->getPaymentInstructions();
    }


    /**
     * @return ConfigInterface
     */
    protected function getConfig()
    {
        return $this->config;
    }

    /**
     * @param ConfigInterface $config
     * @return $this
     */
    protected function setConfig($config)
    {
        $this->config = $config;

        return $this;
    }


    /**
     * @todo
     * @return \Magento\Customer\Api\Data\CustomerInterface|\Magento\Framework\Api\ExtensibleDataInterface
     */
    public function getCustomerBoleto()
    {
        return $this->getQuote()->getCustomer();
    }


    /**
     * @param RequestPaymentSplitLibInterface $paymentSplitRequest
     * @return $this
     */
    public function setPaymentSplitRequest(RequestPaymentSplitLibInterface $paymentSplitRequest)
    {
        $this->paymentSplitRequest = $paymentSplitRequest;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPaymentSplitRequest()
    {
        return $this->paymentSplitRequest;
    }

    public function setPaymentData(InfoInterface $payment)
    {
        $this->paymentData = $payment;
    }

    /**
     * @return bool
     */
    public function getPaymentDoSplit()
    {
        return (bool) $this->getConfig()->isPaymentSplitActive();
    }
}
