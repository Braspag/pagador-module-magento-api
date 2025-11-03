<?php

/**
 * @author      Nexaas Team <dev@nexaas.com>
 * @copyright   2025 Nexaas (http://www.nexxaas.com)
 * @license     http://www.nexaas.com  Copyright
 *
 * @link        http://www.nexaas.com
 *
 */

namespace Braspag\BraspagPagador\Api\Transaction\Resource\Auth3Ds20\Token;

use Braspag\BraspagPagador\Api\Transaction\Resource\RequestAbstract;
use Braspag\BraspagPagador\Api\Transaction\Api\Auth3Ds20\Token\RequestInterface as Data;

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
                'Authorization' => "Bearer " . $this->data->getAccessToken()
            ],
            'body' => [
                'EstablishmentCode' => $this->data->getEstablishmentCode(),
                'MerchantName' => $this->data->getMerchantName(),
                'MCC' => $this->data->getMCC()
            ]
        ];

        return $this;
    }
}