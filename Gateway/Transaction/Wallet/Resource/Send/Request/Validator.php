<?php

namespace Braspag\BraspagPagador\Gateway\Transaction\Pix\Resource\Send\Request;

use Magento\Payment\Gateway\Validator\ValidatorInterface;
use Magento\Payment\Gateway\Validator\Result;
use Braspag\BraspagPagador\Api\Transaction\Api\Pix\Send\RequestInterface;
use Braspag\BraspagPagador\Gateway\Transaction\Pix\Config\ConfigInterface as PixConfigInterface;

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
    protected $pixConfigInterface;

    public function __construct(
        PixConfigInterface $pixConfigInterface
    ) {
        $this->pixConfigInterface = $pixConfigInterface;
    }

    public function validate(array $validationSubject)
    {
        if (!isset($validationSubject['request']) || !$validationSubject['request'] instanceof RequestInterface) {
            throw new \InvalidArgumentException('Braspag Pix Request object should be provided');
        }

        $request = $validationSubject['request'];
        $status = true;
        $message = [];

        return new Result($status, [$message]);
    }
}