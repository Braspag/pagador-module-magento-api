<?php

/**
 * @author      Nexaas Team <dev@nexaas.com>
 * @copyright   2025 Nexaas (http://www.nexxaas.com)
 * @license     http://www.nexaas.com  Copyright
 *
 * @link        http://www.nexaas.com
 *
 */

namespace Braspag\BraspagPagador\Api\Transaction\Resource\OAuth2\Token;

use Braspag\BraspagPagador\Api\Transaction\Api\OAuth2\Token\ResponseInterface;
use Braspag\BraspagPagador\Api\Transaction\Resource\ResponseAbstract;

class Response extends ResponseAbstract implements ResponseInterface
{
    public function getToken()
    {
        if (! isset($this->response['access_token'])) {
            return false;
        }

        return $this->response['access_token'];
    }

    public function getTokenType()
    {
        if (! isset($this->response['token_type'])) {
            return false;
        }
        return $this->response['token_type'];
    }

    public function getExpiresIn()
    {
        if (! isset($this->response['expires_in'])) {
            return false;
        }
        return $this->response['expires_in'];
    }
}