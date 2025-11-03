<?php

namespace Braspag\BraspagPagador\Gateway\Transaction\Voucher\Resource\Order\Response;

use Magento\Payment\Gateway\Validator\ValidatorInterface;
use Magento\Payment\Gateway\Validator\Result;
use Braspag\BraspagPagador\Api\Transaction\Api\Voucher\Send\ResponseInterface;
use Braspag\BraspagPagador\Gateway\Transaction\Voucher\Config\ConfigInterface as VoucherConfigInterface;
use Braspag\BraspagPagador\Gateway\Transaction\Base\Resource\Response\Validator as BaseValidator;

/**
 * Validator
 *
 * Copyright (C) 2021 Signativa/FGP Desenvolvimento de Software
 *
 *  @author Esmerio Neto <esmerio.neto@signativa.com.br>
 *
 * SPDX-License-Identifier: Apache-2.0
 */
class Validator extends BaseValidator implements ValidatorInterface
{
   
    protected $statusDenied;
    protected $voucherConfigInterface;

    public function __construct(
        VoucherConfigInterface $voucherConfigInterface
    ) {
        $this->voucherConfigInterface = $voucherConfigInterface;
    }

    public function validate(array $validationSubject)
    {
        if (!isset($validationSubject['response']) || !$validationSubject['response'] instanceof ResponseInterface) {
            throw new \InvalidArgumentException('Braspag Voucher Authorize Response object should be provided');
        }

        $response = $validationSubject['response'];
        $status = true;
        $message = [];

        if (in_array($response->getPaymentStatus(), $this->getStatusDenied($response))) {
            $status = false;
            $message = $response->getPaymentProviderReturnMessage();
            if (empty($message)) {
                $message = "Voucher Card Payment Failure. #BP{$response->getPaymentStatus()}";
            }
        }

        return new Result($status, [$message]);
    }

    /**
     * @param ResponseInterface $response
     * @return array
     */
    protected function getStatusDenied(ResponseInterface $response)
    {
        if (! $this->statusDenied) {
            $this->statusDenied = [BaseValidator::DENIED, BaseValidator::VOIDED, BaseValidator::ABORTED];
        }

        return $this->statusDenied;
    }
}