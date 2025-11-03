<?php

/**
 * @author      Nexaas Team <dev@nexaas.com>
 * @copyright   2025 Nexaas (http://www.nexxaas.com)
 * @license     http://www.nexaas.com  Copyright
 *
 * @link        http://www.nexaas.com
 *
 */

namespace Braspag\BraspagPagador\Api\Transaction\Api\Boleto\Send;

use Braspag\BraspagPagador\Api\Transaction\Api\AuthRequestInterface;

interface RequestInterface extends AuthRequestInterface
{
    const PAYMENT_TYPE = 'Boleto';

    public function getMerchantOrderId();

    public function getCustomerName();

    public function getCustomerIdentity();

    public function getCustomerIdentityType();

    public function getCustomerEmail();

    public function getCustomerBirthDate();

    public function getCustomerAddressStreet();

    public function getCustomerAddressNumber();

    public function getCustomerAddressComplement();

    public function getCustomerAddressDistrict();

    public function getCustomerAddressZipCode();

    public function getCustomerAddressCity();

    public function getCustomerAddressState();

    public function getCustomerAddressCountry();

    public function getPaymentAmount();

    public function getPaymentProvider();

    public function getPaymentBank();

    public function getPaymentAddress();

    public function getPaymentBoletoNumber();

    public function getPaymentAssignor();

    public function getPaymentDemonstrative();

    public function getPaymentExpirationDate();

    public function getPaymentIdentification();

    public function getPaymentInstructions();
}