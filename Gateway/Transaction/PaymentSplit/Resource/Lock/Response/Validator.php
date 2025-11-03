<?php

namespace Braspag\BraspagPagador\Gateway\Transaction\PaymentSplit\Resource\Lock\Response;

use Magento\Payment\Gateway\Validator\ValidatorInterface;
use Magento\Payment\Gateway\Validator\Result;
use Braspag\BraspagPagador\Api\Transaction\Api\PaymentSplit\Lock\ResponseInterface;
use Braspag\BraspagPagador\Gateway\Transaction\Base\Resource\Response\Validator as BaseValidator;

/**
 * Validator
 *
 * @author      Nexaas Team <dev@nexaas.com>
 * @copyright   2025 Nexaas (http://www.nexxaas.com)
 * @license     http://www.nexaas.com  Copyright
 *
 * @link        http://www.nexaas.com
 */
class Validator extends BaseValidator implements ValidatorInterface
{
 
    protected $statusDenied;

    public function validate(array $validationSubject)
    {
        if (!isset($validationSubject['response']) || !$validationSubject['response'] instanceof ResponseInterface) {
            throw new \InvalidArgumentException('Braspag Credit Card Authorize Response object should be provided');
        }

        $response = $validationSubject['response'];
        $status = true;
        $message = [];

        return new Result($status, [$message]);
    }
}