<?php

namespace Webjump\BraspagPagador\Gateway\Transaction\PaymentSplit\Resource\CreateSubordinate\Response;

use Magento\Payment\Gateway\Validator\ValidatorInterface;
use Magento\Payment\Gateway\Validator\Result;
use Webjump\Braspag\Pagador\Transaction\Api\PaymentSplit\GetSubordinate\ResponseInterface;

/**
 * Validator
 *
 * @author      Nexaas Team <dev@nexaas.com>
 * @copyright   2025 Nexaas (http://www.nexxaas.com)
 * @license     http://www.nexaas.com  Copyright
 *
 * @link        http://www.nexaas.com
 */
class Validator implements ValidatorInterface
{
    public function validate(array $validationSubject)
    {
        if (!isset($validationSubject['response']) || !$validationSubject['response'] instanceof ResponseInterface) {
            throw new \InvalidArgumentException('Braspag Credit Card Authorize Response object should be provided');
        }

        $response = $validationSubject['response'];

        $status = true;
        $message = [];

        if ($response->getStatusCode() === 200) {
            return new Result($status, [$message]);
        }

        $errorsData = $response->getErrorData();

        if (isset($errorsData['Errors']) && is_array($errorsData['Errors']) && !empty($errorsData['Errors'])) {
            foreach ($errorsData['Errors'] as $error) {
                if (isset($error['Message']) && !empty($error['Message'])) {
                    $status = false;
                    $message[] = __($error['Message']);
                }
            }
        }

        return new Result($status, $message);
    }
}