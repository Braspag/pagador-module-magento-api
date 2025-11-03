<?php

/**
 * @author      Nexaas Team <dev@nexaas.com>
 * @copyright   2025 Nexaas (http://www.nexxaas.com)
 * @license     http://www.nexaas.com  Copyright
 *
 * @link        http://www.nexaas.com
 *
 */

namespace Braspag\BraspagPagador\Api\Transaction\Command\OAuth2;

use Braspag\BraspagPagador\Api\Factories\OAuth2ClientHttpFactory;
use Braspag\BraspagPagador\Api\Factories\ResponseFactory;
use Braspag\BraspagPagador\Api\Factories\OAuth2TokenFactory;
use Braspag\BraspagPagador\Api\Transaction\Command\CommandAbstract;

/**
 * Class TokenCommand
 * @package Braspag\BraspagPagador\Api\Transaction\Command\Auth3Ds20
 */
class TokenCommand extends CommandAbstract
{
    /**
     * @return $this
     */
    protected function execute()
    {
        $auth = OAuth2TokenFactory::make($this->request);
        $client = OAuth2ClientHttpFactory::make();

        $params = $this->request->getParams();
        $isTestEnvironment =  (bool) $this->request->getData()->getIsTestEnvironment();

        $response = $client->request($auth, 'POST', '', $isTestEnvironment);

        $this->result = ResponseFactory::make($this->getResponseToArray($response), 'oauth2-token');

        return $this;
    }
}