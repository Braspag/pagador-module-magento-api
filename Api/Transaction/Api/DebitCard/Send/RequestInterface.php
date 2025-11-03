<?php

/**
 * @author      Nexaas Team <dev@nexaas.com>
 * @copyright   2025 Nexaas (http://www.nexxaas.com)
 * @license     http://www.nexaas.com  Copyright
 *
 * @link        http://www.nexaas.com
 *
 */

namespace Braspag\BraspagPagador\Api\Transaction\Api\DebitCard\Send;

use Braspag\BraspagPagador\Api\Transaction\Api\AuthRequestInterface;

interface RequestInterface extends AuthRequestInterface
{
    const PAYMENT_TYPE = 'DebitCard';

    
    public function getPaymentProvider();

    public function getPaymentReturnUrl();

    public function getPaymentDebitCardCardNumber();

    public function getPaymentDebitCardHolder();

    public function getPaymentAuthenticate();

    public function getPaymentDebitCardExpirationDate();

    public function getPaymentDebitCardSecurityCode();

    public function getPaymentDebitCardBrand();

    public function getPaymentCreditSoptpaymenttoken();

    public function getPaymentCreditCardBrand();

    public function getPaymentCreditCardSaveCard();

    public function getPaymentExternalAuthenticationFailureType();

    public function getPaymentExternalAuthenticationCavv();

    public function getPaymentExternalAuthenticationXid();

    public function getPaymentExternalAuthenticationEci();

    public function getPaymentCardExternalAuthenticationVersion();

    public function getPaymentExternalAuthenticationReferenceId();
}