<?php

/**
 * Braspag Transaction CreditCard Authorize Request
 *
 * @author      Nexaas Team <dev@nexaas.com>
 * @copyright   2025 Nexaas (http://www.nexxaas.com)
 * @license     http://www.nexaas.com  Copyright
 *
 * @link        http://www.nexaas.com
 */

namespace Braspag\BraspagPagador\Gateway\Transaction\CreditCard\Resource\Authorize;

use Braspag\BraspagPagador\Api\Transaction\Api\CreditCard\Send\RequestInterface as BraspaglibRequestInterface;
use Braspag\BraspagPagador\Gateway\Transaction\CreditCard\Config\ConfigInterface;
use Braspag\BraspagPagador\Gateway\Transaction\Base\Config\InstallmentsConfigInterface;
use Magento\Payment\Gateway\Data\OrderAdapterInterface;
use Braspag\BraspagPagador\Api\Transaction\Api\AntiFraud\RequestInterface as RequestAntiFraudLibInterface;
use Braspag\BraspagPagador\Api\Transaction\Api\CreditCard\Avs\RequestInterface as RequestAvsLibInterface;
use Braspag\BraspagPagador\Api\Transaction\Api\PaymentSplit\RequestInterface as RequestPaymentSplitLibInterface;
use Braspag\BraspagPagador\Helper\Validator;
use Magento\Payment\Model\InfoInterface;
use Braspag\BraspagPagador\Helper\GrandTotal\Pricing as GrandTotalPricingHelper;
use Braspag\BraspagPagador\Model\Request\CardTwo as TowCard;
use Braspag\BraspagPagador\Gateway\Transaction\Base\Resource\Send\Request as BaseRequest;
use Braspag\BraspagPagador\Helper\Data;

/**
 * Class Request
 * @package Braspag\BraspagPagador\Gateway\Transaction\CreditCard\Resource\Authorize
 */
class Request extends BaseRequest  implements BraspaglibRequestInterface, RequestInterface
{
    const CODE_BY_CARD = '2';

    /**
     * @var
     */
    protected $orderAdapter;
    /**
     * @var
     */
    protected $paymentData;
    /**
     * @var
     */
    protected $config;
    /**
     * @var
     */
    protected $installmentsConfig;
    /**
     * @var
     */
    protected $billingAddress;
    /**
     * @var
     */
    protected $shippingAddress;
    /**
     * @var
     */
    protected $antiFraudRequest;
    /**
     * @var
     */
    protected $quote;
    /**
     * @var
     */
    protected $avsRequest;

    /**
     * @var
     */
    protected $paymentSplitRequest;

    /**
     * Helper validator.
     *
     * @var Validator
     */
    protected $validator;

    /**
     * @var
     */
    protected $typeCard;


    /**
     * @var GrandTotalPricingHelper
     */
    protected $grandTotalPricingHelper;

    protected $helperData;

    protected $cardTwo;


    /**
     * Request constructor.
     *
     * @param ConfigInterface $config 
     * @param InstallmentsConfigInterface $installmentsConfig 
     * @param Validator $validator 
     * @param GrandTotalPricingHelper $grandTotalPricingHelper 
     * @param \Braspag\BraspagPagador\Helper\Data $helperData
     * @param TowCard $cardTwo 
     */
    public function __construct(
        ConfigInterface $config,
        InstallmentsConfigInterface $installmentsConfig,
        Validator $validator,
        GrandTotalPricingHelper $grandTotalPricingHelper,
        Data $helperData,
        TowCard $cardTwo
    ) {
        $this->config = $config;
        $this->installmentsConfig = $installmentsConfig;
        $this->validator = $validator;
        $this->grandTotalPricingHelper = $grandTotalPricingHelper;
        $this->helperData = $helperData;
        $this->cardTwo = $cardTwo;
    }


    /**
     * @return mixed
     */
    public function getCustomerIdentity()
    {

        if ($this->getCardType() == 'two_card') {
            $taxVat = $this->cardTwo->getData('taxvat_card2');
            if (!is_null($taxVat) || isset($taxVat))
                return $this->helperData->removeSpecialCharactersFromTaxvat($taxVat);
        }

        if ($this->getCardType() == 'primary_card') {
            $taxVat = $this->cardTwo->getData('taxvat_card');
            if (!is_null($taxVat) || isset($taxVat))
                return $this->helperData->removeSpecialCharactersFromTaxvat($taxVat);
        }

        $ccTaxvat = $this->getPaymentData()->getAdditionalInformation('cc_taxvat');
        if (!is_null($ccTaxvat) || isset($ccTaxvat))
            return $this->helperData->removeSpecialCharactersFromTaxvat($ccTaxvat);


        return $this->helperData->removeSpecialCharactersFromTaxvat(
            ($this->getQuote()->getBillingAddress()->getData('vat_id') != null) ?
                $this->getQuote()->getBillingAddress()->getData('vat_id') :
                $this->getQuote()->getData('customer_taxvat')
        );
    }



    /**
     * @param  $typeCard
     * @return $this
     */
    public function setCardType($typeCard)
    {
        $this->typeCard = $typeCard;
    }


    /**
     * @return mixed
     */
    public function getCardType()
    {
        return $this->typeCard;
    }


    /**
     * @return mixed
     */
    public function getPaymentAmount()
    {

        try {
            $grandTotalAmount = $this->getOrderAdapter()->getGrandTotalAmount();
            $installment = $this->getPaymentInstallments();

            if ($this->getCardType() == 'two_card')
                $grandTotalAmount =   str_replace(',', '.',  str_replace('.', '',  $this->cardTwo->getData('total_amount')));

            if ($this->getCardType() == 'primary_card')
                $grandTotalAmount =  $grandTotalAmount - str_replace(',', '.',  str_replace('.', '',  $this->cardTwo->getData('total_amount')));


            $installmentsMaxWithoutInterest   = $this->getInstallmentsConfig()->getinstallmentsMaxWithoutInterest();
            $interestRate = $this->getInstallmentsConfig()->getInterestRate();

            if (
                isset($installmentsMaxWithoutInterest)
                && $installmentsMaxWithoutInterest > 0
                && isset($interestRate)
                && $interestRate > 0
                && ($installment > $this->getInstallmentsConfig()->getinstallmentsMaxWithoutInterest())
            ) {
                $amountTotal =  $this->calcPriceWithInterest($installment, $grandTotalAmount, $this->getInstallmentsConfig()->getInterestRate());
                $integerValue = $this->grandTotalPricingHelper->currency($amountTotal * $installment);
            } else {
                $integerValue = $this->grandTotalPricingHelper->currency($grandTotalAmount);
            }
        } catch (\Exception $e) {
            throw new \InvalidArgumentException('Error getPaymentAmount');
        }

        if ($integerValue <= 0 || is_null($integerValue))
            throw new \InvalidArgumentException('Amount value zero');

        return $integerValue;
    }


    /**
     * @return mixed
     */
    public function getPaymentProvider()
    {
        $ccType = $this->getPaymentData()->getCcType();

        if ($this->getCardType() == 'two_card') {
            $ccType = $this->cardTwo->getData('cc_type');
        }

        if (!empty($ccType)) {

            if ($this->getConfig()->getIsTestEnvironment()) {
                return 'Simulado';
            }

            list($provider, $brand) = array_pad(explode('-', $ccType, 2), 2, null);

            if ($provider === "Braspag") {
                $availableTypes = explode(',', $this->getConfig()->getCcTypes());


                foreach ($availableTypes as $key => $availableType) {
                    $typeDetail = explode("-", $availableType);
                    if (isset($typeDetail[1]) && $typeDetail[1] == $brand) {
                        return $typeDetail[0];
                    }
                }


                return "";
            }

            return $provider;
        }

        return "";
    }


    /**
     * @return int
     */
    public function getPaymentInstallments()
    {
        if (!$installments = $this->getPaymentData()->getAdditionalInformation('cc_installments')) {
            $installments = 1;
        }

        if ($this->getCardType() == 'two_card')
            $installments = $this->cardTwo->getData('cc_installments');

        return $installments;
    }

    /**
     * @return string
     */
    public function getPaymentInterest()
    {
        return $this->getInstallmentsConfig()->isInterestByIssuer() ? 'ByIssuer' : 'ByMerchant';
    }

    /**
     * @return mixed
     */
    protected function getInstallmentsConfig()
    {
        return $this->installmentsConfig;
    }

    /**
     * @return bool
     */
    public function getPaymentDoSplit()
    {
        return (bool) $this->getConfig()->isPaymentSplitActive();
    }

    /**
     * @return bool
     */
    public function getPaymentCapture()
    {
        return (bool) $this->getConfig()->isAuthorizeAndCapture();
    }

    /**
     * @return mixed
     */
    public function getReturnUrl()
    {
        return $this->getConfig()->getReturnUrl();
    }

    /**
     * @return mixed
     */
    public function getPaymentSoftDescriptor()
    {
        return $this->getConfig()->getSoftDescriptor();
    }

    /**
     * @return mixed
     */
    public function getPaymentCreditCardCardNumber()
    {
        return $this->getCardType() == 'two_card' ?  $this->cardTwo->getData('cc_number') :  $this->getPaymentData()->getCcNumber();
    }

    /**
     * @return mixed
     */
    public function getPaymentCreditCardHolder()
    {
        return $this->getCardType() == 'two_card' ?  $this->cardTwo->getData('cc_owner') :  $this->getPaymentData()->getCcOwner();
    }

    /**
     * @return string
     */
    public function getPaymentCreditCardExpirationDate()
    {
        $this->getCardType() == 'two_card' ? $ccExpMonth  = $this->cardTwo->getData('cc_exp_month') :  $ccExpMonth = $this->getPaymentData()->getCcExpMonth();

        $this->getCardType() == 'two_card' ? $ccExpYear  =  $this->cardTwo->getData('cc_exp_year') :  $ccExpYear = $this->getPaymentData()->getCcExpYear();

        return str_pad($ccExpMonth, 2, '0', STR_PAD_LEFT) . '/' . $ccExpYear;
    }

    /**
     * @return mixed
     */
    public function getPaymentCreditCardSecurityCode()
    {
        return $this->getCardType() == 'two_card' ? $this->cardTwo->getData('cc_cid') :  $this->getPaymentData()->getCcCid();
    }

    /**
     * @return bool
     */
    public function getPaymentCreditCardSaveCard()
    {
        return (bool) $this->getPaymentData()->getAdditionalInformation('cc_savecard');
    }

    /**
     * @return string
     */
    public function getPaymentCreditCardBrand()
    {

        $ccType =  $this->getPaymentData()->getCcType();

        if ($this->getCardType() == 'two_card') {

            if ($this->cardTwo->getData('cc_token')) {
                return null;
            } else {
                $ccType = $this->cardTwo->getData('cc_type');
            }
        } elseif ($this->getPaymentData()->getAdditionalInformation('cc_token')) {
            return null;
        }


        if($this->getPaymentData()->getAdditionalInformation('cc_soptpaymenttoken'))
            $ccType = $this->getPaymentData()->getAdditionalInformation('cc_type');

        if (empty($ccType)) {
            throw new \Magento\Framework\Exception\LocalizedException(
                __('Credit card brand is required. Please select your card brand and try again.')
            );
        }

        list($provider, $brand) = array_pad(explode('-', $ccType, 2), 2, null);

        if (empty($brand)) {
            throw new \Magento\Framework\Exception\LocalizedException(
                __('Credit card brand is required. Please select your card brand and try again.')
            );
        }

        return $brand;
    }


    /**
     * @return bool
     */
    public function getPaymentAuthenticate()
    {
        if ($this->getPaymentData()->getAdditionalInformation('cc_token') || ConfigInterface::CONFIG_XML_BRASPAG_PAGADOR_CREDITCARD_TWO_CARD_ACTIVE)
            return false;

        return (bool) $this->getConfig()->isAuth3Ds20Active()
            && $this->getPaymentExternalAuthenticationFailureType() != ConfigInterface::BRASPAG_PAGADOR_CREDITCARD_AUTHENTICATION_3DS_20_RETURN_TYPE_DISABLED;
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
     * @return null
     */
    public function getPaymentExtraDataCollection()
    {
        return null;
    }

    /**
     * @return RequestAntiFraudLibInterface
     */
    public function getAntiFraudRequest()
    {
        return $this->antiFraudRequest;
    }

    /**
     * @param RequestAntiFraudLibInterface $antiFraudRequest
     */
    public function setAntiFraudRequest(RequestAntiFraudLibInterface $antiFraudRequest)
    {
        $this->antiFraudRequest = $antiFraudRequest;
    }

    /**
     * @param RequestAvsLibInterface $avsRequest
     * @return $this
     */
    public function setAvsRequest(RequestAvsLibInterface $avsRequest)
    {
        $this->avsRequest = $avsRequest;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getAvsRequest()
    {
        return $this->avsRequest;
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
     * @param OrderAdapterInterface $orderAdapter
     * @return $this
     */
    public function setOrderAdapter(OrderAdapterInterface $orderAdapter)
    {
        $this->orderAdapter = $orderAdapter;

        return $this;
    }

    /**
     * @param InfoInterface $payment
     */
    public function setPaymentData(InfoInterface $payment)
    {
        $this->paymentData = $payment;
    }

    /**
     * @return mixed
     */
    public function getPaymentCreditCardCardToken()
    {
        return $this->getCardType() == 'two_card' ?  $this->cardTwo->getData('cc_token') :   $this->getPaymentData()->getAdditionalInformation('cc_token');
    }

    /**
     * @return mixed
     */
    public function getPaymentCreditSoptpaymenttoken()
    {
        return $this->getPaymentData()->getAdditionalInformation('cc_soptpaymenttoken');
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
     * @return mixed
     */
    protected function getOrderAdapter()
    {
        return $this->orderAdapter;
    }


    /**
     * @param InstallmentsConfigInterface $installmentsConfig
     * @return $this
     */
    protected function setInstallmentsConfig(InstallmentsConfigInterface $installmentsConfig)
    {
        $this->installmentsConfig = $installmentsConfig;

        return $this;
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
     * @todo
     * @return ConfigInterface
     */
    public function getCustomerCreditCard()
    {
        return $this->getQuote()->getCustomer();
    }

    protected function calcPriceWithInterest($i, $total, $interestRate)
    {
        $price = $total * $interestRate / (1 - (1 / pow((1 + $interestRate), $i)));
        return sprintf("%01.2f", $price);
    }
}
