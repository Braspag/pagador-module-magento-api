<?php

namespace Braspag\BraspagPagador\Gateway\Transaction\DebitCard\Resource\Order;

use Braspag\BraspagPagador\Gateway\Transaction\DebitCard\Config\ConfigInterface;
use Braspag\BraspagPagador\Gateway\Transaction\Base\Resource\RequestInterface as BraspagMagentoRequestInterface;
use Braspag\BraspagPagador\Api\Transaction\Api\DebitCard\Send\RequestInterface as BraspaglibRequestInterface;
use Braspag\BraspagPagador\Api\Transaction\Api\PaymentSplit\RequestInterface as RequestPaymentSplitLibInterface;
use Braspag\BraspagPagador\Gateway\Transaction\Base\Resource\Send\Request as BaseRequest;
use Magento\Payment\Gateway\Data\OrderAdapterInterface;
use Magento\Payment\Model\InfoInterface;

/**
 * Debit Order request
 *
 * @author      Nexaas Team <dev@nexaas.com>
 * @copyright   2025 Nexaas (http://www.nexxaas.com)
 * @license     http://www.nexaas.com  Copyright
 *
 * @link        http://www.nexaas.com
 */
class Request extends BaseRequest implements BraspagMagentoRequestInterface, BraspaglibRequestInterface
{
    protected $config;

    protected $orderAdapter;

    protected $paymentData;

    protected $billingAddress;

    protected $helperData;

    /**
     * @var
     */
    protected $antiFraudRequest;

    /**
     * @var
     */
    protected $paymentSplitRequest;

    public function __construct(
        ConfigInterface $config,
        \Braspag\BraspagPagador\Helper\Data $helperData
    ) {
        $this->setConfig($config);
        $this->helperData = $helperData;
    }


    public function getPaymentProvider()
    {
        list($provider, $brand) = array_pad(explode('-', (string) ($this->getPaymentData()->getCcType() ?? ''), 2), 2, null);

        if ($provider === "Braspag") {
            $availableTypes = explode(',', (string) ($this->getConfig()->getDcTypes() ?? ''));

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

    public function getPaymentDebitCardCardNumber()
    {
        return $this->getPaymentData()->getCcNumber();
    }

    public function getPaymentDebitCardHolder()
    {
        return $this->getPaymentData()->getCcOwner();
    }

    public function getPaymentDebitCardExpirationDate()
    {
        return str_pad($this->getPaymentData()->getCcExpMonth(), 2, '0', STR_PAD_LEFT) . '/' . $this->getPaymentData()->getCcExpYear();
    }

    public function getPaymentDebitCardSecurityCode()
    {
        return $this->getPaymentData()->getCcCid();
    }

    public function getPaymentDebitCardBrand()
    {
        list($provider, $brand) = array_pad(explode('-', (string) ($this->getPaymentData()->getCcType() ?? ''), 2), 2, null);

        return $brand;
    }

    public function getPaymentCreditSoptpaymenttoken()
    {
        return $this->getPaymentData()->getAdditionalInformation('cc_soptpaymenttoken');
    }

    public function getPaymentCreditCardBrand()
    {
        list($provider, $brand) = array_pad(explode('-', (string) ($this->getPaymentData()->getCcType() ?? ''), 2), 2, null);

        return ($brand) ? $brand : 'Visa';
    }

    public function getPaymentCreditCardSaveCard()
    {
        return (bool) $this->getPaymentData()->getAdditionalInformation('cc_savecard');
    }


    /**
     * @return bool
     */
    public function getPaymentAuthenticate()
    {
        return (bool) $this->getConfig()->isAuth3Ds20Active()
            && $this->getPaymentExternalAuthenticationFailureType() != ConfigInterface::BRASPAG_PAGADOR_DEBIT_AUTHENTICATION_3DS_20_RETURN_TYPE_DISABLED;
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


}