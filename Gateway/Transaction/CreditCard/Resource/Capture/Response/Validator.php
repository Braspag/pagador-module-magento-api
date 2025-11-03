<?php

namespace Braspag\BraspagPagador\Gateway\Transaction\CreditCard\Resource\Capture\Response;

use Magento\Payment\Gateway\Validator\ValidatorInterface;
use Magento\Payment\Gateway\Validator\Result;
use Braspag\BraspagPagador\Api\Transaction\Api\Actions\Capture\ResponseInterface;

/**
 * Validator
 *
 * @author      Nexaas Team <dev@nexaas.com>
 * @copyright   2018 Webjump (http://www.nexaas.com)
 * @license     http://www.nexaas.com  Copyright
 *
 * @link        http://www.nexaas.com
 */
class Validator implements ValidatorInterface
{
    const SUCCESS = 0;

    protected $statusDenied;

    public function validate(array $validationSubject)
    {

        if (!isset($validationSubject['response']) || !$validationSubject['response'] instanceof ResponseInterface) {
            throw new \InvalidArgumentException('Braspag Credit Card Capture Response object should be provided');
        }

        $response = $validationSubject['response'];
        $status = true;
        $message = [];

        if ($response->getReasonCode() != self::SUCCESS) {
            $status = false;
            $message = [$response->getProviderReturnMessage()];
        }

        return new Result($status, $message);
    }
}