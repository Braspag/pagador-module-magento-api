<?php

namespace Braspag\BraspagPagador\Gateway\Transaction\CreditCard\Resource\Authorize\Response;

use Magento\Payment\Gateway\Response\HandlerInterface;
use Magento\Sales\Model\Order;
use Braspag\BraspagPagador\Api\Transaction\Api\AntiFraud\ResponseInterface as AntiFraudResponseInterface;
use Magento\Checkout\Model\Session as CheckoutSession;
use Braspag\BraspagPagador\Api\Transaction\Resource\CreditCard\Send\Response;
use Braspag\BraspagPagador\Gateway\Transaction\Base\Resource\Response\AbstractHandler;

/**

 * Braspag Transaction CreditCard Authorize Response Handler
 *
 * @author      Nexaas Team <dev@nexaas.com>
 * @copyright   2025 Nexaas (http://www.nexxaas.com)
 * @license     http://www.nexaas.com  Copyright
 *
 * @link        http://www.nexaas.com
 */
class StatusAntiFraudHandler extends AbstractHandler implements HandlerInterface
{
    const STATUS_ACCEPT = 1;
    const STATUS_REJECT = 2;
    const STATUS_REVIEW = 3;
    const STATUS_ABORTED = 4;
    const STATUS_ERROR = 5;

    public function __construct(
        Response $response
    ) {
        $this->setResponse($response);
    }

    protected function _handle($payment, $response)
    {
        $antiFraudResponse = $response->getPaymentFraudAnalysis();

        if (! ($antiFraudResponse instanceof AntiFraudResponseInterface)) {
            return $this;
        }

        switch ($antiFraudResponse->getStatus()) {
            case self::STATUS_REJECT:
                $payment->setIsFraudDetected(true);
                break;
            case self::STATUS_REVIEW:
            case self::STATUS_ABORTED:
            case self::STATUS_ERROR:
                $payment->setIsTransactionPending(true);
                break;
        }

        return $response;
    }
}