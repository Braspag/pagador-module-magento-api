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

interface ResponseInterface
{
    public function getPaymentAuthenticationUrl();

    public function getPaymentAcquirerTransactionId();

    public function getPaymentProofOfSale();

    public function getPaymentPaymentId();

    public function getPaymentReceivedDate();

    public function getPaymentReasonCode();

    public function getPaymentReasonMessage();

    public function getPaymentStatus();

    public function getPaymentAuthenticate();

    public function getPaymentProviderReturnCode();

    public function getPaymentProviderReturnMessage();

    public function getPaymentLinks();

    public function getPaymentCardProvider();
}