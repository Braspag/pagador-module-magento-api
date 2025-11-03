<?php

namespace Braspag\BraspagPagador\Gateway\Transaction\CreditCard\Resource\Authorize;

use Braspag\BraspagPagador\Gateway\Transaction\Base\Resource\RequestInterface as BaseRequestInterface;
use Braspag\BraspagPagador\Api\Transaction\Api\AntiFraud\RequestInterface as RequestAntiFraudLibInterface;
use Braspag\BraspagPagador\Api\Transaction\Api\CreditCard\Avs\RequestInterface as RequestAvsLibInterface;
use Braspag\BraspagPagador\Api\Transaction\Api\PaymentSplit\RequestInterface as RequestPaymentSplitLibInterface;

/**
 * Braspag Transaction CreditCard Authorize Request Interface
 *
 * @author      Nexaas Team <dev@nexaas.com>
 * @copyright   2025 Nexaas (http://www.nexxaas.com)
 * @license     http://www.nexaas.com  Copyright
 *
 * @link        http://www.nexaas.com
 */
interface RequestInterface extends BaseRequestInterface
{
    public function setAntiFraudRequest(RequestAntiFraudLibInterface $requestAntiFraud);

    public function setAvsRequest(RequestAvsLibInterface $requestAntiFraud);

    public function setPaymentSplitRequest(RequestPaymentSplitLibInterface $requestAntiFraud);
}
