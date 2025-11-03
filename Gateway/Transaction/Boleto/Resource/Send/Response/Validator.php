<?php

namespace Braspag\BraspagPagador\Gateway\Transaction\Boleto\Resource\Send\Response;

use Magento\Payment\Gateway\Validator\ValidatorInterface;
use Magento\Payment\Gateway\Validator\Result;
use Braspag\BraspagPagador\Api\Transaction\Api\Boleto\Send\ResponseInterface;
use Braspag\BraspagPagador\Gateway\Transaction\Boleto\Config\ConfigInterface as BoletoConfigInterface;
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
    protected $boletoConfigInterface;

    public function __construct(
        BoletoConfigInterface $boletoConfigInterface
    ) {
        $this->boletoConfigInterface = $boletoConfigInterface;
    }

    public function validate(array $validationSubject)
    {
        if (!isset($validationSubject['response']) || !$validationSubject['response'] instanceof ResponseInterface) {
            throw new \InvalidArgumentException('Braspag Boleto Authorize Response object should be provided');
        }

        $response = $validationSubject['response'];
        $status = true;
        $message = [];

        if (in_array($response->getPaymentStatus(), $this->getStatusDenied($response))) {
            $status = false;
            $message = $response->getPaymentProviderReturnMessage();
            if (empty($message)) {
                $message = "Boleto Payment Failure. #BP{$response->getPaymentStatus()}";
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
            $this->statusDenied = [BaseValidator::DENIED, BaseValidator::NOTFINISHED, BaseValidator::ABORTED];
        }

        return $this->statusDenied;
    }
}