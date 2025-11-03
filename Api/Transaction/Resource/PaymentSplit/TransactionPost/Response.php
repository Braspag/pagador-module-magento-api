<?php

/**
 * @author      Nexaas Team <dev@nexaas.com>
 * @copyright   2025 Nexaas (http://www.nexxaas.com)
 * @license     http://www.nexaas.com  Copyright
 *
 * @link        http://www.nexaas.com
 *
 */

namespace Braspag\BraspagPagador\Api\Transaction\Resource\PaymentSplit\TransactionPost;

use Braspag\BraspagPagador\Api\Transaction\Api\PaymentSplit\ResponseInterface;
use Braspag\BraspagPagador\Api\Transaction\Resource\ResponseAbstract;

class Response extends ResponseAbstract implements ResponseInterface
{
    public function getSplits()
    {
        if (!isset($this->response['SplitPayments'])) {
            return $this->response;
        }
        return $this->response['SplitPayments'];
    }

    public function getPaymentId()
    {
        if (!isset($this->response['PaymentId'])) {
            return false;
        }
        return $this->response['PaymentId'];
    }
}