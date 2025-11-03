<?php

/**
 * Braspag Transaction Base  Request
 *
 * @author      Nexaas Team <dev@nexaas.com>
 * @copyright   2025 Nexaas (http://www.nexxaas.com)
 * @license     http://www.nexaas.com  Copyright
 *
 * @link        http://www.nexaas.com
 */

namespace Braspag\BraspagPagador\Gateway\Transaction\Base\Resource\Send;

use Magento\Payment\Gateway\Data\OrderAdapterInterface;
use Braspag\BraspagPagador\Gateway\Transaction\Base\Config\ConfigInterface;
use Braspag\BraspagPagador\Api\Transaction\Api\PaymentSplit\RequestInterface as RequestPaymentSplitLibInterface;
use Braspag\BraspagPagador\Helper\Validator;
use Magento\Payment\Model\InfoInterface;
use Braspag\BraspagPagador\Helper\GrandTotal\Pricing as GrandTotalPricingHelper;


/**
 * Class Request
 * @package Braspag\BraspagPagador\Gateway\Transaction\Base\Resource\Send
 */
class Request
{
    

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
    protected $billingAddress;
    /**
     * @var
     */
    protected $shippingAddress;
    /**
     * @var
     */
    protected $quote;
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
     * @var GrandTotalPricingHelper
     */
    protected $grandTotalPricingHelper;
    /**
     * @var helperData
     */
    protected $helperData;
    /**
     * @var cardTwo
     */
    protected $cardTwo;


    /**
     * Request constructor.
     * @param ConfigInterface $config
     * @param InstallmentsConfigInterface $installmentsConfig
     * @param Validator $validator
     */
    public function __construct(
        Validator $validator,
        GrandTotalPricingHelper $grandTotalPricingHelper,
        ConfigInterface $config,
        \Braspag\BraspagPagador\Helper\Data $helperData,
    ) {
        $this->setConfig($config);
        $this->validator = $validator;
        $this->grandTotalPricingHelper = $grandTotalPricingHelper;
        $this->helperData = $helperData;
        
    }


     /**
     * @return ConfigInterface
     */
    protected function getConfig()
    {
        return $this->config;
    }

    /**
     * @param  $config
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
    public function getMerchantId()
    {
        return $this->getConfig()->getMerchantId();
    }

    /**
     * @return mixed
     */
    public function getMerchantKey()
    {
        return $this->getConfig()->getMerchantKey();
    }

    /**
     * @return mixed
     */
    public function isTestEnvironment()
    {
        return $this->getConfig()->getIsTestEnvironment();
    }

    /**
     * @return mixed
     */
    public function getMerchantOrderId()
    {
        return  $this->getOrderAdapter()->getOrderIncrementId();
    }

    /**
     * @return string
     */
    public function getCustomerName()
    {
        return $this->helperData->removeSpecialCharacters(
            trim($this->getBillingAddress()->getFirstname() . ' ' . $this->getBillingAddress()->getLastname())
        );
    }

    /**
     * @return mixed
     */
    public function getCustomerIdentity()
    {
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
     * @return string
     */
    public function getCustomerIdentityType()
    {
        $customerIdenty = $this->getCustomerIdentity();

        if ($customerIdenty) {
            return (strlen((string) preg_replace('/[^A-Za-z0-9]/', '', $customerIdenty)) > 11) ? 'CNPJ' : 'CPF';
        }

        return '';
    }

    /**
     * @return mixed
     */
    public function getCustomerEmail()
    {
        return $this->getBillingAddress()->getEmail();
    }

    /**
     * Gender Value
     *
     * @return string|null
     */
    public function getCustomerBirthDate()
    {
        $dob = null;
        $dob = $this->getQuote()->getCustomerDob() == null ? $this->getQuote()->getCustomer()->getDob() : $this->getQuote()->getCustomerDob();

        $customerDob = null;
        if ($dob != null){
            $customerDob = str_replace(" 00:00:00", "", $dob);
        }

        return $customerDob;
    }

    /**
     * @return string
     */
    public function getCustomerAddressStreet()
    {
        return $this->getBillingAddressAttribute($this->getConfig()->getCustomerStreetAttribute());
    }

    /**
     * @return string
     */
    public function getCustomerAddressNumber()
    {
        return $this->getBillingAddressAttribute($this->getConfig()->getCustomerNumberAttribute());
    }

    /**
     * @return string
     */
    public function getCustomerAddressComplement()
    {
        $addressComplement = $this->getBillingAddressAttribute($this->getConfig()->getCustomerComplementAttribute());
        return isset($addressComplement) ? $addressComplement = $this->helperData->removeSpecialCharacters(substr($addressComplement, 0, 10)) : '';
    }

    /**
     * @return mixed
     */
    public function getCustomerAddressZipCode()
    {
        return preg_replace('/[^0-9]/', '', $this->getBillingAddress()->getPostcode());
    }

    /**
     * @return array
     */
    public function getCustomerAddressDistrict()
    {
        return $this->validator->sanitizeDistrict($this->getBillingAddressAttribute($this->getConfig()->getCustomerDistrictAttribute()));
    }

    /**
     * @return mixed
     */
    public function getCustomerAddressCity()
    {
        return $this->getBillingAddress()->getCity();
    }

    /**
     * @return mixed
     */
    public function getCustomerAddressState()
    {
        return $this->getBillingAddress()->getRegionCode();
    }

    /**
     * @return mixed
     */
    public function getFromDevice()
    {
        return  $this->getPaymentData()->getAdditionalInformation('from_device');
    }

    /**
     * @return string
     */
    public function getCustomerAddressCountry()
    {
        return 'BRA';
    }

    /**
     * @return mixed
     */
    public function getCustomerAddressPhone()
    {

        $phone =  substr(preg_replace('/[^0-9]/', '', $this->getBillingAddress()->getTelephone()), 0, 11);
        return ConfigInterface::COUNTRY_TELEPHONE_CODE . '' .
            substr($phone, 0, 2) . '' . substr($phone, 2, 5) . '' . substr($phone, 7);
    }

    /**
     * @return string
     */
    public function getCustomerDeliveryAddressStreet()
    {
        return $this->getShippingAddressAttribute($this->getConfig()->getCustomerStreetAttribute());
    }

    /**
     * @return string
     */
    public function getCustomerDeliveryAddressNumber()
    {
        return $this->getShippingAddressAttribute($this->getConfig()->getCustomerNumberAttribute());
    }

    /**
     * @return string
     */
    public function getCustomerDeliveryAddressComplement()
    {
        $addressComplement = $this->getShippingAddressAttribute($this->getConfig()->getCustomerComplementAttribute());
        return isset($addressComplement) ? $addressComplement = $this->helperData->removeSpecialCharacters(substr($addressComplement, 0, 10)) : '';
    }

    /**
     * @return mixed
     */
    public function getCustomerDeliveryAddressZipCode()
    {
        if ($this->getShippingAddress()) {
            return $this->getShippingAddress()->getPostcode();
        }

        return null;
    }

    /**
     * @return string
     */
    public function getCustomerDeliveryAddressDistrict()
    {
        return $this->validator->sanitizeDistrict($this->getShippingAddressAttribute($this->getConfig()->getCustomerDistrictAttribute()));
    }

    /**
     * @return mixed
     */
    public function getCustomerDeliveryAddressCity()
    {
        if ($this->getShippingAddress()) {
            return $this->getShippingAddress()->getCity();
        }

        return null;
    }

    /**
     * @return mixed
     */
    public function getCustomerDeliveryAddressState()
    {
        if ($this->getShippingAddress()) {
            return $this->getShippingAddress()->getRegionCode();
        }

        return null;
    }

    /**
     * @return string
     */
    public function getCustomerDeliveryAddressCountry()
    {
        if (!$this->getShippingAddress()) {
            return '';
        }

        return 'BRA';
    }

    /**
     * @return mixed
     */
    public function getCustomerDeliveryAddressPhone()
    {
        return $this->getShippingAddress()->getTelephone();
    }

    /**
     * @return bool
     */
    public function getPaymentType()
    {
        return false;
    }

    /**
     * @return mixed
     */
    public function getPaymentAmount()
    {
        $amount = (float) round($this->getOrderAdapter()->getGrandTotalAmount(), 2) * 100;
        return str_replace('.', '', $amount);
    }

    /**
     * @return string
     */
    public function getPaymentCurrency()
    {
        return 'BRL';
    }

    /**
     * @return string
     */
    public function getPaymentCountry()
    {
        return 'BRA';
    }

 
    /**
     * @return int
     */
    public function getPaymentServiceTaxAmount()
    {
        return 0;
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
     * @param $attribute
     * @return string
     */
    protected function getBillingAddressAttribute($attribute)
    {
        if (preg_match('/^street_/', $attribute)) {
            $line = (int) str_replace('street_', '', $attribute);
            return $this->getQuoteBillingAddress()->getStreetLine($line);
        }

        $this->getQuoteBillingAddress()->getData($attribute);
    }

    /**
     * @param $attribute
     * @return string
     */
    protected function getShippingAddressAttribute($attribute)
    {
        if (preg_match('/^street_/', $attribute)) {
            $line = (int) str_replace('street_', '', $attribute);
            return $this->getQuoteShippingAddress()->getStreetLine($line);
        }

        $this->getQuoteShippingAddress()->getData($attribute);
    }

  
    /**
     * @return mixed
     */
    protected function getOrderAdapter()
    {
        return $this->orderAdapter;
    }

    /**
     * @return mixed
     */
    protected function getPaymentData()
    {
        return $this->paymentData;
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
     * @return mixed
     */
    protected function getBillingAddress()
    {
        if (!$this->billingAddress) {
            $this->billingAddress = $this->getOrderAdapter()->getBillingAddress();
        }

        return $this->billingAddress;
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
     * @todo
     * @return ConfigInterface
     */
    public function getCustomerCreditCard()
    {
        return $this->getQuote()->getCustomer();
    }

    /**
     * @return \Magento\Quote\Model\Quote\Address
     */
    protected function getQuoteBillingAddress()
    {
        return $this->getQuote()->getBillingAddress();
    }

    /**
     * @return \Magento\Quote\Model\Quote\Address
     */
    protected function getQuoteShippingAddress()
    {
        return $this->getQuote()->getShippingAddress();
    }

}
