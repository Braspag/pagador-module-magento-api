<?php

namespace Braspag\BraspagPagador\Gateway\Transaction\PaymentSplit\Command;

use Braspag\BraspagPagador\Gateway\Transaction\Base\Command\AbstractApiCommand;
use Braspag\BraspagPagador\Api\Transaction\Api\PaymentSplit\GetSubordinate\RequestInterface;

/**
 * Braspag Transaction Credit Create Subordinate Command
 *
 * @author      Nexaas Team <dev@nexaas.com>
 * @copyright   2021 Webjump (http://www.nexaas.com)
 * @license     http://www.nexaas.com  Copyright
 *
 * @link        http://www.nexaas.com
 */
class GetSubordinateCommand extends AbstractApiCommand
{
    /**
     * @param array $commandSubject
     * @return \Magento\Payment\Gateway\Command\ResultInterface|mixed|AbstractApiCommand|null
     * @throws \Magento\Sales\Exception\CouldNotInvoiceException
     */
    public function execute(array $commandSubject)
    {
        $request = $this->getRequestBuilder()->build($commandSubject);

        if ($this->getRequestValidator()) {
            $result = $this->getRequestValidator()->validate(
                array_merge($commandSubject, ['request' => $request])
            );

            if (!$result->isValid()) {
                $errorMessage = $result->getFailsDescription();

                throw new LocalizedException(
                    __(reset($errorMessage))
                );
            }
        }

        $this->getRequestHandler()->handle($commandSubject, ['request' => $request]);

        $response = $this->sendRequest($request);

        if ($this->getResponseValidator()) {
            $result = $this->getResponseValidator()->validate(
                array_merge($commandSubject, ['response' => $response])
            );

            if (!$result->isValid()) {
                $errorMessage = $result->getFailsDescription();

                throw new LocalizedException(
                    __(reset($errorMessage))
                );
            }
        }

        $this->getResponseHandler()->handle($commandSubject, ['response' => $response]);

        return $response;
    }

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
            return $this->getApi()->sendSplitPaymentGetSubordinate($request);
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            throw new \Magento\Sales\Exception\CouldNotInvoiceException(
                __('Braspag communication error. Error code: ' . $e->getCode())
            );
        }
    }
}