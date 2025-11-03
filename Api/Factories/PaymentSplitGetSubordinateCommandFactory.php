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

use Braspag\BraspagPagador\Api\Transaction\Command\PaymentSplit\GetSubordinateCommand;
use Braspag\BraspagPagador\Api\Transaction\Resource\RequestAbstract;

class PaymentSplitGetSubordinateCommandFactory
{
    /**
     * @param RequestAbstract $request
     * @return CreateSubordinateCommand
     */
    public static function make(RequestAbstract $request)
    {
        return new GetSubordinateCommand($request);
    }
}