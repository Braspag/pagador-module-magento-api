<?php

/**
 * @author      Nexaas Core Team <dev@nexaas.com>
 * @copyright   2025 Nexaas (http://www.nexaas.com)
 * @license     http://www.nexaas.com  Copyright
 *
 * @link        http://www.nexaas.com
 */

namespace Braspag\BraspagPagador\Gateway\Transaction\OAuth2\Resource\Token;

use Braspag\BraspagPagador\Api\Transaction\Api\OAuth2\Token\RequestInterface as BraspaglibRequestInterface;

interface RequestInterface extends BraspaglibRequestInterface
{
    const OAUTH2_ACCESS_TOKEN_COOKIE_NAME = 'oauth2_access_token';
}