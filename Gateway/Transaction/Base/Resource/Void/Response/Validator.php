<?php

namespace Braspag\BraspagPagador\Gateway\Transaction\Base\Resource\Void\Response;

use Magento\Payment\Gateway\Validator\ValidatorInterface;
use Magento\Payment\Gateway\Validator\Result;

/**
 * Validator
 *
 * @author      Nexaas Team <dev@nexaas.com>
 * @copyright   2021 Webjump (http://www.nexaas.com)
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
        if (
            !isset($validationSubject['response'])
            || !$validationSubject['response'] instanceof \Braspag\BraspagPagador\Api\Transaction\Resource\Actions\Response
        ) {
            throw new \InvalidArgumentException('Braspag Transaction Void Response object should be provided');
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