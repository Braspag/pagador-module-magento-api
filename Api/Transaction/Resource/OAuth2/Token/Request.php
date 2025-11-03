<?php

/**
 * @author      Nexaas Team <dev@nexaas.com>
 * @copyright   2025 Nexaas (http://www.nexxaas.com)
 * @license     http://www.nexaas.com  Copyright
 *
 * @link        http://www.nexaas.com
 *
 */

namespace Braspag\BraspagPagador\Api\Transaction\Resource\OAuth2\Token;

use Braspag\BraspagPagador\Api\Transaction\Resource\RequestAbstract;
use Braspag\BraspagPagador\Api\Transaction\Api\OAuth2\Token\RequestInterface as Data;

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
                'Content-Type' => self::CONTENT_TYPE_APPLICATION_X_WWW_FORM_URLENCODED,
                'Authorization' => "Basic " . $this->data->getAccessToken()
            ],
            'form_params' => [
                'grant_type' => 'client_credentials'
            ]
        ];

        return $this;
    }
}