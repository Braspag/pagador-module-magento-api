<?php

/**
 * @author      Nexaas Team <dev@nexaas.com>
 * @copyright   2025 Nexaas (http://www.nexxaas.com)
 * @license     http://www.nexaas.com  Copyright
 *
 * @link        http://www.nexaas.com
 *
 */

namespace Braspag\BraspagPagador\Api\Transaction\Resource\PaymentSplit\GetSubordinate;

use Braspag\BraspagPagador\Api\Transaction\Resource\RequestAbstract;
use Braspag\BraspagPagador\Api\Transaction\Api\PaymentSplit\GetSubordinate\RequestInterface as Data;

class Request extends RequestAbstract
{
    /**
     * Request constructor.
     * @param Data $data
     */
    public function __construct(Data $data)
    {
        $this->data = $data;
        $this->prepareParams();
    }

    /**
     * @return $this
     */
    protected function prepareParams()
    {
        $this->params['headers'] = [
            'Content-Type' => "application/json",
            'Authorization' => "Bearer " . $this->data->getAccessToken()
        ];

        $this->params['subordinateMerchantId'] = $this->data->getSubordinateMerchantId();

        return $this;
    }
}