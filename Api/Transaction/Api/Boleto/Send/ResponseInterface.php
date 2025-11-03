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

interface ResponseInterface
{
    public function getPaymentUrl();

    public function getPaymentBoletoNumber();

    public function getPaymentBarCodeNumber();

    public function getPaymentPaymentId();

    public function getPaymentReceivedDate();

    public function getPaymentReasonCode();

    public function getPaymentReasonMessage();

    public function getPaymentStatus();

    public function getPaymentLinks();

    public function getDigitableLine();

    public function getExpirationDate();
}