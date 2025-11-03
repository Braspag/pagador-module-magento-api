<?php

/**
 * @author      Nexaas Team <dev@nexaas.com>
 * @copyright   2025 Nexaas (http://www.nexxaas.com)
 * @license     http://www.nexaas.com  Copyright
 *
 * @link        http://www.nexaas.com
 *
 */

namespace Braspag\BraspagPagador\Api\Transaction\Api\CreditCard\Send;

interface ResponseInterface
{
    public function getPayment();

    public function getPaymentProofOfSale();

    public function getPaymentAcquirerTransactionId();

    public function getPaymentAuthorizationCode();

    public function getPaymentPaymentId();

    public function getPaymentReceivedDate();

    public function getPaymentCapturedDate();

    public function getPaymentStatus();

    public function getPaymentAuthenticate();

    public function getPaymentReasonCode();

    public function getPaymentReasonMessage();

    public function getPaymentProviderReturnCode();

    public function getPaymentProviderReturnMessage();

    public function getPaymentLinks();

    public function getPaymentFraudAnalysis();

    public function getPaymentCardToken();

    public function getPaymentCardNumberEncrypted();

    public function getPaymentCardBrand();

    public function getAuthenticationUrl();

    public function getPaymentCardProvider();

    public function getPaymentSplitPayments();

    public function getVelocityAnalysis();

    public function getAvs();
}