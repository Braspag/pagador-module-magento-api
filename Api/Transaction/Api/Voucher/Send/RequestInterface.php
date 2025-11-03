<?php

/**
 * @author      Nexaas Team <dev@nexaas.com>
 * @copyright   2025 Nexaas (http://www.nexxaas.com)
 * @license     http://www.nexaas.com  Copyright
 *
 * @link        http://www.nexaas.com
 *
 */

namespace Braspag\BraspagPagador\Api\Transaction\Api\Voucher\Send;

use Braspag\BraspagPagador\Api\Transaction\Api\AuthRequestInterface;

interface RequestInterface extends AuthRequestInterface
{
    const PAYMENT_TYPE = 'Voucher';

    public function getMerchantOrderId();

    public function getCustomerName();

    public function getCustomerIdentity();

    public function getCustomerIdentityType();

    public function getCustomerEmail();

    public function getCustomerBirthDate();

    public function getCustomerAddressStreet();

    public function getCustomerAddressNumber();

    public function getCustomerAddressComplement();

    public function getCustomerAddressZipCode();

    public function getCustomerAddressDistrict();

    public function getCustomerAddressCity();

    public function getCustomerAddressState();

    public function getCustomerAddressCountry();

    public function getCustomerAddressPhone();

    public function getCustomerDeliveryAddressStreet();

    public function getCustomerDeliveryAddressNumber();

    public function getCustomerDeliveryAddressComplement();

    public function getCustomerDeliveryAddressZipCode();

    public function getCustomerDeliveryAddressDistrict();

    public function getCustomerDeliveryAddressCity();

    public function getCustomerDeliveryAddressState();

    public function getCustomerDeliveryAddressCountry();

    public function getCustomerDeliveryAddressPhone();

    public function getPaymentAmount();

    public function getPaymentProvider();

    public function getPaymentReturnUrl();

    public function getPaymentVoucherCardNumber();

    public function getPaymentVoucherHolder();

    public function getPaymentAuthenticate();

    public function getPaymentVoucherExpirationDate();

    public function getPaymentVoucherSecurityCode();

    public function getPaymentVoucherBrand();

    public function getPaymentVoucherSoptpaymenttoken();

    public function getPaymentVoucherSaveCard();

    public function getPaymentExternalAuthenticationFailureType();

    public function getPaymentExternalAuthenticationCavv();

    public function getPaymentExternalAuthenticationXid();

    public function getPaymentExternalAuthenticationEci();

    public function getPaymentCardExternalAuthenticationVersion();

    public function getPaymentExternalAuthenticationReferenceId();

    public function getPaymentCurrency();

    public function getPaymentCountry();

    public function getRemoteIpAddress();
}