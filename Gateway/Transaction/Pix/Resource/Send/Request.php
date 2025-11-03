<?php

namespace Braspag\BraspagPagador\Gateway\Transaction\Pix\Resource\Send;

use Braspag\BraspagPagador\Gateway\Transaction\Pix\Resource\Send\RequestInterface as BraspagMagentoRequestInterface;
use Braspag\BraspagPagador\Gateway\Transaction\Pix\Config\ConfigInterface;
use Braspag\BraspagPagador\Api\Transaction\Api\Pix\Send\RequestInterface as BraspaglibRequestInterface;
use Braspag\BraspagPagador\Api\Transaction\Api\PaymentSplit\RequestInterface as RequestPaymentSplitLibInterface;
use Magento\Payment\Model\InfoInterface;
use Magento\Payment\Gateway\Data\OrderAdapterInterface;
use Braspag\BraspagPagador\Helper\Validator;
use Braspag\BraspagPagador\Gateway\Transaction\Base\Resource\Send\Request as BaseRequest;

/**
 * Braspag Transaction Pix Send Request
 *
 * @author      Esmerio Neto <esmerio.neto@signativa.com.br>
 * @copyright   (C) 2021 Signativa/FGP Desenvolvimento de Software
 * SPDX-License-Identifier: Apache-2.0
 *
 */
class Request extends BaseRequest implements BraspagMagentoRequestInterface, BraspaglibRequestInterface
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
    public function getCustomerIdentity()
    {             
        return $this->helperData->removeSpecialCharactersFromTaxvat(
            ( $this->getQuote()->getBillingAddress()->getData('vat_id') != null ) ? 
            $this->getQuote()->getBillingAddress()->getData('vat_id') : 
            $this->getQuote()->getData('customer_taxvat') 
        );

    }


    /**
     * @return mixed
     */
    public function getPaymentProvider()
    {
        return $this->getConfig()->getPaymentProvider();
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
    public function getPaymentBank()
    {
        return $this->getConfig()->getPaymentBank();
    }

    /**
     * @return mixed
     */
    public function getPaymentPixNumber()
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
     * @param ConfigInterface $config
     * @return $this
     */
    protected function setConfig( $config)
    {
        $this->config = $config;

        return $this;
    }

    /**
     * @todo
     * @return \Magento\Customer\Api\Data\CustomerInterface|\Magento\Framework\Api\ExtensibleDataInterface
     */
    public function getCustomerPix()
    {
        return $this->getQuote()->getCustomer();
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