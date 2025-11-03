<?php

/**
 * @author      Nexaas Team <dev@nexaas.com>
 * @copyright   2025 Nexaas (http://www.nexxaas.com)
 * @license     http://www.nexaas.com  Copyright
 *
 * @link        http://www.nexaas.com
 *
 */

namespace Braspag\BraspagPagador\Api\Factories;

use Braspag\BraspagPagador\Api\Transaction\Resource\OAuth2\Token\Request;
use Braspag\BraspagPagador\Api\Transaction\Api\OAuth2\Token\RequestInterface as Data;

class OAuth2TokenRequestFactory
{
    /**
     * @param Data $data
     * @param string $type
     * @return Request
     */
    public static function make(Data $data, $type = '')
    {
        return new Request($data, $type);
    }
}