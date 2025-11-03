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

use Braspag\BraspagPagador\Api\Transaction\Command\OAuth2\TokenCommand;
use Braspag\BraspagPagador\Api\Transaction\Resource\RequestAbstract;

class OAuth2TokenCommandFactory
{
    /**
     * @param RequestAbstract $request
     * @return GetTokenCommand
     */
    public static function make(RequestAbstract $request)
    {
        return new TokenCommand($request);
    }
}