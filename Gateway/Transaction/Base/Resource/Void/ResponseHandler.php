<?php

namespace Braspag\BraspagPagador\Gateway\Transaction\Base\Resource\Void;

use Magento\Payment\Gateway\Data\PaymentDataObjectInterface;
use Magento\Payment\Gateway\Response\HandlerInterface;
use Magento\Sales\Model\Order\Payment;
use Braspag\BraspagPagador\Api\Transaction\Api\Actions\Void\ResponseInterface;

/**
 * Braspag Transaction CreditCard Capture Response Handler
 *
 * @author      Nexaas Team <dev@nexaas.com>
 * @copyright   2021 Webjump (http://www.nexaas.com)
 * @license     http://www.nexaas.com  Copyright
 *
 * @link        http://www.nexaas.com
 */
class ResponseHandler implements HandlerInterface
{
    public function handle(array $handlingSubject, array $response)
    {
        if (!isset($handlingSubject['payment']) || !$handlingSubject['payment'] instanceof PaymentDataObjectInterface) {
            throw new \InvalidArgumentException('Payment data object should be provided');
        }

        if (!isset($response['response']) || !$response['response'] instanceof ResponseInterface) {
            throw new \InvalidArgumentException('Braspag Transaction Void Response Lib object should be provided');
        }

        /** @var ResponseInterface $response */
        $response = $response['response'];
        $paymentDO = $handlingSubject['payment'];
        $payment = $paymentDO->getPayment();

        // $payment->setTransactionId($response->getTransactionId());
        $payment->setIsTransactionClosed(true);

        return $this;
    }
}
