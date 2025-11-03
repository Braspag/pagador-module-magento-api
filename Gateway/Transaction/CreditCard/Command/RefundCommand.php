<?php

namespace Braspag\BraspagPagador\Gateway\Transaction\CreditCard\Command;

use Braspag\BraspagPagador\Gateway\Transaction\Base\Command\AbstractApiCommand;
use Braspag\BraspagPagador\Api\Transaction\Api\Actions\RequestInterface;

/**
 * Braspag Transaction Credit Capture Command
 *
 * @author      Nexaas Team <dev@nexaas.com>
 * @copyright   2025 Nexaas (http://www.nexxaas.com)
 * @license     http://www.nexaas.com  Copyright
 *
 * @link        http://www.nexaas.com
 */
class RefundCommand extends AbstractApiCommand
{
    /**
     * @param $request
     * @return mixed
     * @throws \Magento\Sales\Exception\CouldNotInvoiceException Avoid the SDK throw to \Exception
     */
    protected function sendRequest($request)
    {
        if (!isset($request) || !$request instanceof RequestInterface) {
            throw new \InvalidArgumentException('Braspag Credit Card Refund Request Lib object should be provided');
        }

        try {
            return $this->getApi()->voidPayment($request);
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            throw new \Magento\Sales\Exception\CouldNotInvoiceException(
                __('Braspag communication error. Error code: ' . $e->getCode())
            );
        }
    }
}
