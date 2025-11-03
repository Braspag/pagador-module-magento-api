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

use Braspag\BraspagPagador\Api\Http\Services\PaymentSplit\GetSubordinate as GetSubordinate;
use Braspag\BraspagPagador\Api\Transaction\Resource\RequestAbstract;

class PaymentSplitGetSubordinateFactory
{
    /**
     * @param RequestAbstract $request
     * @return Sales
     */
    public static function make(RequestAbstract $request)
    {
        return new GetSubordinate($request);
    }
}