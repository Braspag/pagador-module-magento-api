<?php

/**
 * @author      Nexaas Core Team <dev@nexaas.com>
 * @copyright   2025 Nexaas (http://www.nexaas.com)
 * @license     http://www.nexaas.com  Copyright
 *
 * @link        http://www.nexaas.com
 */

namespace Braspag\BraspagPagador\Gateway\Transaction\OAuth2\Resource\Token;

use Braspag\BraspagPagador\Gateway\Transaction\OAuth2\Config\Config;

class Request extends Config implements RequestInterface
{
    public function getAccessToken()
    {
        $clientId = $this->getOAuth2ClientId();
        $clientSecret = $this->getOAuth2ClientSecret();

        return base64_encode($clientId . ":" . $clientSecret);
    }
}