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

use Braspag\BraspagPagador\Api\Transaction\Resource\Actions\Request;
use Braspag\BraspagPagador\Api\Transaction\Api\Actions\RequestInterface as Data;

class PaymentRequestFactory
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