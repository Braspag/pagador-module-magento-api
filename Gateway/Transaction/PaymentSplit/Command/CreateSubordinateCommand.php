<?php

namespace Braspag\BraspagPagador\Gateway\Transaction\PaymentSplit\Command;

use Braspag\BraspagPagador\Gateway\Transaction\Base\Command\AbstractApiCommand;
use Braspag\BraspagPagador\Api\Transaction\Api\PaymentSplit\CreateSubordinate\RequestInterface;

/**
 * Braspag Transaction Credit Create Subordinate Command
 *
 * @author      Nexaas Team <dev@nexaas.com>
 * @copyright   2020 Webjump (http://www.nexaas.com)
 * @license     http://www.nexaas.com  Copyright
 *
 * @link        http://www.nexaas.com
 */
class CreateSubordinateCommand extends AbstractApiCommand
{
    /**
     * @param $request
     * @return mixed
     * @throws \Magento\Sales\Exception\CouldNotInvoiceException
     */
    protected function sendRequest($request)
    {
        if (!isset($request) || !$request instanceof RequestInterface) {
            throw new \InvalidArgumentException('Braspag Split Transaction Create Subordinate Send Request Lib object should be provided');
        }

        try {
            return $this->getApi()->sendSplitPaymentCreateSubordinate($request);
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            throw new \Magento\Sales\Exception\CouldNotInvoiceException(
                __('Braspag communication error. Error code: ' . $e->getCode())
            );
        }
    }
}