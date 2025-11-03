<?php

namespace Braspag\BraspagPagador\Gateway\Transaction\PaymentSplit\Command;

use Braspag\BraspagPagador\Gateway\Transaction\Base\Command\AbstractApiCommand;
use Braspag\BraspagPagador\Api\Transaction\Api\PaymentSplit\Lock\RequestInterface;

/**
 * Braspag Transaction Credit Authorize Command
 *
 * @author      Nexaas Team <dev@nexaas.com>
 * @copyright   2020 Webjump (http://www.nexaas.com)
 * @license     http://www.nexaas.com  Copyright
 *
 * @link        http://www.nexaas.com
 */
class LockCommand extends AbstractApiCommand
{
    protected function sendRequest($request)
    {
        if (!isset($request) || !$request instanceof RequestInterface) {
            throw new \InvalidArgumentException('Braspag Boleto Split Transaction Post Send Request Lib object should be provided');
        }

        try {
            return $this->getApi()->sendSplitPaymentLock($request);
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            throw new \Magento\Sales\Exception\CouldNotInvoiceException(
                __('Braspag communication error. Error code: ' . $e->getCode())
            );
        }
    }
}