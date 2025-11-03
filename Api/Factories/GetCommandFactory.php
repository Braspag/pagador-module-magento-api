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

use Braspag\BraspagPagador\Api\Transaction\Command\Sales\GetCommand;
use Braspag\BraspagPagador\Api\Transaction\Resource\RequestAbstract;

class GetCommandFactory
{
    /**
     * @param RequestAbstract $request
     * @return GetCommand
     */
    public static function make(RequestAbstract $request)
    {
        return new GetCommand($request);
    }
}