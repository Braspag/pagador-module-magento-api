<?php

namespace Braspag\BraspagPagador\Gateway\Transaction\DebitCard\Resource\Order\Response;

use Magento\Payment\Gateway\Validator\ValidatorInterface;
use Magento\Payment\Gateway\Validator\Result;
use Braspag\BraspagPagador\Api\Transaction\Api\DebitCard\Send\ResponseInterface;
use Braspag\BraspagPagador\Gateway\Transaction\DebitCard\Config\ConfigInterface as DebitCardConfigInterface;
use Braspag\BraspagPagador\Gateway\Transaction\Base\Resource\Response\Validator as BaseValidator;

/**
 * Validator
 *
 * @author      Nexaas Team <dev@nexaas.com>
 * @copyright   2019 Webjump (http://www.nexaas.com)
 * @license     http://www.nexaas.com  Copyright
 *
 * @link        http://www.nexaas.com
 */
class Validator  extends BaseValidator implements ValidatorInterface
{

    protected $statusDenied;
    protected $debitCardConfigInterface;

    public function __construct(
        DebitCardConfigInterface $debitCardConfigInterface
    ) {
        $this->debitCardConfigInterface = $debitCardConfigInterface;
    }

    public function validate(array $validationSubject)
    {
        if (!isset($validationSubject['response']) || !$validationSubject['response'] instanceof ResponseInterface) {
            throw new \InvalidArgumentException('Braspag Debit Authorize Response object should be provided');
        }

        $response = $validationSubject['response'];
        $status = true;
        $message = [];

        if (in_array($response->getPaymentStatus(), $this->getStatusDenied($response))) {
            $status = false;
            $message = $response->getPaymentProviderReturnMessage();
            if (empty($message)) {
                $message = "Debit Card Payment Failure. #BP{$response->getPaymentStatus()}";
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