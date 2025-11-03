<?php

/**
 * @author      Nexaas Core Team <dev@nexaas.com>
 * @copyright   2025 Nexaas (http://www.nexaas.com)
 * @license     http://www.nexaas.com  Copyright
 *
 * @link        http://www.nexaas.com
 */

namespace Braspag\BraspagPagador\Gateway\Transaction\Auth3Ds20\Resource\Token;

use Braspag\BraspagPagador\Api\Transaction\Api\Auth3Ds20\Token\RequestInterface as BraspaglibRequestInterface;

interface RequestInterface extends BraspaglibRequestInterface
{
    const BPMPI_ACCESS_TOKEN_COOKIE_NAME = 'bpmpi_access_token';
}