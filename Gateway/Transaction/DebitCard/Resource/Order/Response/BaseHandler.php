<?php

namespace Braspag\BraspagPagador\Gateway\Transaction\DebitCard\Resource\Order\Response;

use Magento\Payment\Gateway\Response\HandlerInterface;
use Braspag\BraspagPagador\Api\Transaction\Resource\DebitCard\Send\Response;
use Braspag\BraspagPagador\Gateway\Transaction\Base\Resource\Response\AbstractHandler;

/**

 * Braspag Transaction DebitCard Order Response Handler
 *
 * @author      Nexaas Team <dev@nexaas.com>
 * @copyright   2025 Nexaas (http://www.nexxaas.com)
 * @license     http://www.nexaas.com  Copyright
 *
 * @link        http://www.nexaas.com
 */
class BaseHandler extends AbstractHandler implements HandlerInterface
{
    public function __construct(
        Response $response
    ) {
        $this->setResponse($response);
    }

    /**
     * @param $payment
     * @param $response
     * @return $this
     */
    protected function _handle($payment, $response)
    {
        list($paymentProvider, $paymentBrand) = array_pad(explode('-', (string) ($payment->getCcType() ?? ''), 2), 2, null);
        list($responseProvider, $responseBrand) = array_pad(explode('-', (string) ($response->getPaymentCardProvider() ?? ''), 2), 2, null);
        $payment->setAdditionalInformation('send_provider', $paymentProvider);
        $payment->setAdditionalInformation('receive_provider', $responseProvider);

        $payment->setTransactionId($response->getPaymentPaymentId());
        $payment->setAdditionalInformation('redirect_url', $response->getPaymentAuthenticationUrl());
        $payment->setAdditionalInformation('braspag_payment_status', $response->getPaymentStatus());

        $payment->setIsTransactionClosed(false);

        return $response;
    }
}