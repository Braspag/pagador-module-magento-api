<?php

/**
 * @author      Nexaas Team <dev@nexaas.com>
 * @copyright   2019 Webjump (http://www.nexaas.com)
 * @license     http://www.nexaas.com  Copyright
 *
 * @link        http://www.nexaas.com
 *
 */

namespace Braspag\BraspagPagador\Api\Transaction\Api\Auth3Ds20\Token;

interface ResponseInterface
{
    public function getToken();

    public function getTokenType();

    public function getExpiresIn();
}