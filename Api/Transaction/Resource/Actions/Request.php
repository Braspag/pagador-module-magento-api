<?php

/**
 * @author      Nexaas Team <dev@nexaas.com>
 * @copyright   2025 Nexaas (http://www.nexxaas.com)
 * @license     http://www.nexaas.com  Copyright
 *
 * @link        http://www.nexaas.com
 *
 */

namespace Braspag\BraspagPagador\Api\Transaction\Resource\Actions;

use Braspag\BraspagPagador\Api\Transaction\Resource\RequestAbstract;
use Braspag\BraspagPagador\Api\Transaction\Api\Actions\RequestInterface as Data;

class Request extends RequestAbstract
{
    protected $type;

    /**
     * @param Data $data
     * @param string $type
     */
    public function __construct(Data $data, $type = '')
    {
        $this->type = $type;
        $this->data = $data;
        $this->prepareParams();
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return $this
     */
    protected function prepareParams()
    {
        $this->params = [
            'headers' => [
                'Content-Type' => self::CONTENT_TYPE_APPLICATION_JSON,
                'MerchantId' => $this->data->getMerchantId($this->data->getStoreId()),
                'MerchantKey' => $this->data->getMerchantKey($this->data->getStoreId())
            ],
            'uriComplement' => [
                'payment_id' => $this->data->getPaymentId(),
                'additional' => $this->data->getAdditionalRequest()
            ],

        ];

        if (!empty($this->data->getRequestDataBody())) {
            $this->params['body'] = $this->data->getRequestDataBody();
        }

        return $this;
    }
}