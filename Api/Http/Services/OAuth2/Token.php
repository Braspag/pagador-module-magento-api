<?php

/**
 * @author      Nexaas Team <dev@nexaas.com>
 * @copyright   2019 Webjump (http://www.nexaas.com)
 * @license     http://www.nexaas.com  Copyright
 *
 * @link        http://www.nexaas.com
 *
 */

namespace Braspag\BraspagPagador\Api\Http\Services\OAuth2;

use Braspag\BraspagPagador\Api\Http\Services\ServiceAbstract;
use Braspag\BraspagPagador\Api\Http\Services\ServiceInterface;

class Token extends ServiceAbstract implements ServiceInterface
{
    protected $endPoint = 'oauth2/token';
}