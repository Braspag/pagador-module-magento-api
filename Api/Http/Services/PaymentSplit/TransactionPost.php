<?php

/**
 * @author      Nexaas Team <dev@nexaas.com>
 * @copyright   2019 Webjump (http://www.nexaas.com)
 * @license     http://www.nexaas.com  Copyright
 *
 * @link        http://www.nexaas.com
 *
 */

namespace Braspag\BraspagPagador\Api\Http\Services\PaymentSplit;

use Braspag\BraspagPagador\Api\Http\Services\ServiceAbstract;
use Braspag\BraspagPagador\Api\Http\Services\ServiceInterface;

class TransactionPost extends ServiceAbstract implements ServiceInterface
{
    protected $endPoint = "api/transactions/%s/split";

    public function getEndPoint()
    {
        $params = $this->getRequest()->getParams();

        if (isset($params['orderPaymentTransactionId'])) {
            return sprintf($this->endPoint, $params['orderPaymentTransactionId']);
        }

        return $this->endPoint;
    }
}