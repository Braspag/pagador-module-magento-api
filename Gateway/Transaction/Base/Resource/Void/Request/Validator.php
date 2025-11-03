<?php

namespace Braspag\BraspagPagador\Gateway\Transaction\Base\Resource\Void\Request;

use Magento\Payment\Gateway\Validator\ValidatorInterface;
use Magento\Payment\Gateway\Validator\Result;
use Braspag\BraspagPagador\Api\Transaction\Api\Actions\RequestInterface;

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
    const SUCCESS = 0;

    protected $statusDenied;

    public function validate(array $validationSubject)
    {

        if (!isset($validationSubject['request']) || !$validationSubject['request'] instanceof RequestInterface) {
            throw new \InvalidArgumentException('Braspag Transaction Void Request object should be provided');
        }

        return new Result(true, []);
    }
}