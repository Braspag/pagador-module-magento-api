<?php

namespace Braspag\BraspagPagador\Gateway\Transaction\Boleto\Resource\Send\Request;

use Magento\Payment\Gateway\Validator\ValidatorInterface;
use Magento\Payment\Gateway\Validator\Result;
use Braspag\BraspagPagador\Api\Transaction\Api\Boleto\Send\RequestInterface;
use Braspag\BraspagPagador\Gateway\Transaction\Boleto\Config\ConfigInterface as BoletoConfigInterface;

/**
 * Validator
 *
 * @author      Nexaas Team <dev@nexaas.com>
 * @copyright   2019 Webjump (http://www.nexaas.com)
 * @license     http://www.nexaas.com  Copyright
 *
 * @link        http://www.nexaas.com
 */
class Validator implements ValidatorInterface
{
    protected $boletoConfigInterface;

    public function __construct(
        BoletoConfigInterface $boletoConfigInterface
    ) {
        $this->boletoConfigInterface = $boletoConfigInterface;
    }

    public function validate(array $validationSubject)
    {
        if (!isset($validationSubject['request']) || !$validationSubject['request'] instanceof RequestInterface) {
            throw new \InvalidArgumentException('Braspag Boleto Request object should be provided');
        }

        $request = $validationSubject['request'];
        $status = true;
        $message = [];

        return new Result($status, [$message]);
    }
}