<?php

namespace Braspag\BraspagPagador\Gateway\Transaction\Voucher\Resource\Order;


use Braspag\BraspagPagador\Gateway\Transaction\Base\Resource\Send\Request as BaseRequest;
use Braspag\BraspagPagador\Gateway\Transaction\Voucher\Config\ConfigInterface;
use Braspag\BraspagPagador\Gateway\Transaction\Base\Resource\RequestInterface as BraspagMagentoRequestInterface;
use Braspag\BraspagPagador\Api\Transaction\Api\Voucher\Send\RequestInterface as BraspaglibRequestInterface;
use Braspag\BraspagPagador\Api\Transaction\Api\PaymentSplit\RequestInterface as RequestPaymentSplitLibInterface;
use Magento\Payment\Gateway\Data\OrderAdapterInterface;
use Magento\Payment\Model\InfoInterface;
use Braspag\BraspagPagador\Helper\Validator;
use Magento\Framework\HTTP\PhpEnvironment\RemoteAddress;
use Magento\Customer\Api\CustomerRepositoryInterface;


/**
 * Voucher Order request
 *
 * Copyright (C) 2021 Signativa/FGP Desenvolvimento de Software
 *
 *  @author Esmerio Neto <esmerio.neto@signativa.com.br>
 *
 * SPDX-License-Identifier: Apache-2.0
 */
class Request  extends BaseRequest  implements BraspagMagentoRequestInterface, BraspaglibRequestInterface
{
    protected $config;

    protected $orderAdapter;

    protected $paymentData;

    protected $billingAddress;

    protected $helperData;

    protected $quote;

    /**
     * @var
     */
    protected $antiFraudRequest;

    /**
     * @var
     */
    protected $paymentSplitRequest;

    /**
     * @var
     */
    protected $shippingAddress;

    /**
     * Helper validator.
     *
     * @var Validator
     */
    protected $validator;

    /**
     *
     * @var
     */
    protected $remote;

    /**
     * @var CustomerRepositoryInterface
     */
    private $customerRepository;

    /**
    * @var date
    */
    protected $timezone;

    public function __construct(
        ConfigInterface $config,
        \Braspag\BraspagPagador\Helper\Data $helperData,
        Validator $validator,
        RemoteAddress $remote,
        CustomerRepositoryInterface $customerRepository
    ) {
        $this->setConfig($config);
        $this->helperData = $helperData;
        $this->validator = $validator;
        $this->remote = $remote;
        $this->customerRepository = $customerRepository;
    }

    public function setOrderAdapter(OrderAdapterInterface $orderAdapter)
    {
        $this->orderAdapter = $orderAdapter;

        return $this;
    }

    public function setPaymentData(InfoInterface $payment)
    {
        $this->paymentData = $payment;
    }


    /**
     * @return \Magento\Quote\Model\Quote
     */
    protected function getQuote()
    {
        return $this->quote;
    }

    /**
     * @param \Magento\Quote\Model\Quote $quote
     */
    public function setQuote($quote)
    {
        $this->quote = $quote;
        return $this;
    }


    /**
     * @return bool
     */
    public function getPaymentType()
    {
        return false;
    }

    public function getPaymentAmount()
    {
        $amount = $this->getOrderAdapter()->getGrandTotalAmount() * 100;

        return str_replace('.', '', $amount);
    }

    public function getPaymentProvider()
    {

        list($provider, $brand) = array_pad(explode('-', (string) ($this->getPaymentData()->getCcType() ?? ''), 2), 2, null);

        if ($provider === "Braspag") {
            $availableTypes = explode(',', (string) ($this->getConfig()->getVcTypes() ?? ''));

            foreach ($availableTypes as $key => $availableType) {
                $typeDetail = explode("-", $availableType);
                if (isset($typeDetail[1]) && $typeDetail[1] == $brand) {
                    return $typeDetail[0];
                }
            }

            if ($this->getConfig()->getIsTestEnvironment()) {
                return "Simulado";
            }

            return "";
        }

        return $provider;
    }

    /**
     * @return bool
     */
    public function getPaymentDoSplit()
    {
        return (bool) $this->getConfig()->isPaymentSplitActive();
    }

    public function getPaymentReturnUrl()
    {
        return $this->getConfig()->getPaymentReturnUrl();
    }

    public function getPaymentVoucherCardNumber()
    {
        return $this->getPaymentData()->getCcNumber();
    }

    public function getPaymentVoucherHolder()
    {
        return $this->getPaymentData()->getCcOwner();
    }

    public function getPaymentVoucherExpirationDate()
    {
        return str_pad($this->getPaymentData()->getCcExpMonth(), 2, '0', STR_PAD_LEFT) . '/' . $this->getPaymentData()->getCcExpYear();
    }

    public function getPaymentVoucherSecurityCode()
    {
        return $this->getPaymentData()->getCcCid();
    }

    public function getPaymentVoucherBrand()
    {
        list($provider, $brand) = array_pad(explode('-', (string) ($this->getPaymentData()->getCcType() ?? ''), 2), 2, null);

        return $brand;
    }

    public function getPaymentVoucherSoptpaymenttoken()
    {
        return $this->getPaymentData()->getAdditionalInformation('cc_soptpaymenttoken');
    }


    public function getPaymentVoucherSaveCard()
    {
        return (bool) $this->getPaymentData()->getAdditionalInformation('cc_savecard');
    }

    /**
     * @return ConfigInterface
     */
    protected function getConfig()
    {
        return $this->config;
    }

    protected function setConfig($config)
    {
        $this->config = $config;

        return $this;
    }

    protected function getOrderAdapter()
    {
        return $this->orderAdapter;
    }

    protected function getPaymentData()
    {
        return $this->paymentData;
    }


    /**
     * @return bool
     */
    public function getPaymentAuthenticate()
    {
        return (bool) false
            && $this->getPaymentExternalAuthenticationFailureType();
    }

    /**
     * @return string
     */
    public function getPaymentExternalAuthenticationFailureType()
    {
        return $this->getPaymentData()->getAdditionalInformation('authentication_failure_type');
    }

    /**
     * @return mixed
     */
    public function getPaymentExternalAuthenticationCavv()
    {
        return $this->getPaymentData()->getAdditionalInformation('authentication_cavv');
    }

    /**
     * @return string
     */
    public function getPaymentExternalAuthenticationXid()
    {
        return $this->getPaymentData()->getAdditionalInformation('authentication_xid');
    }

    /**
     * @return string
     */
    public function getPaymentExternalAuthenticationEci()
    {
        return $this->getPaymentData()->getAdditionalInformation('authentication_eci');
    }

    /**
     * @return string
     */
    public function getPaymentCardExternalAuthenticationVersion()
    {
        return $this->getPaymentData()->getAdditionalInformation('authentication_version');
    }

    /**
     * @return string
     */
    public function getPaymentExternalAuthenticationReferenceId()
    {
        return $this->getPaymentData()->getAdditionalInformation('authentication_reference_id');
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



    /**
     * @return \Magento\Quote\Model\Quote\Address
     */
    protected function getQuoteShippingAddress()
    {
        return $this->getQuote()->getShippingAddress();
    }

    /**
     * @return mixed
     */
    protected function getShippingAddress()
    {
        if (!$this->shippingAddress) {
            $this->shippingAddress = $this->getOrderAdapter()->getShippingAddress();
        }

        return $this->shippingAddress;
    }


    /**
     * @return int
     */
    public function getPaymentServiceTaxAmount()
    {
        return 0;
    }

    /**
     * @return int
     */
    public function getPaymentInstallments()
    {
        $installments = 1;
        return $installments;
    }

    public function getRemoteIpAddress()
    {
        return $this->remote->getRemoteAddress();
    }


}