<?php

/**
 * @author      Nexaas Team <dev@nexaas.com>
 * @copyright   2025 Nexaas (http://www.nexxaas.com)
 * @license     http://www.nexaas.com  Copyright
 *
 * @link        http://www.nexaas.com
 *
 */

namespace Braspag\BraspagPagador\Api\Transaction\Command\Auth3Ds20;

use Braspag\BraspagPagador\Api\Factories\Auth3Ds20ClientHttpFactory;
use Braspag\BraspagPagador\Api\Factories\ResponseFactory;
use Braspag\BraspagPagador\Api\Factories\Auth3Ds20TokenFactory;
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
        $auth = Auth3Ds20TokenFactory::make($this->request);
        $client = Auth3Ds20ClientHttpFactory::make();

        $params = $this->request->getParams();
        $isTestEnvironment =  (bool) $this->request->getData()->getIsTestEnvironment();

        $response = $client->request($auth, 'POST', '', $isTestEnvironment);

        $this->result = ResponseFactory::make($this->getResponseToArray($response), 'auth-token');

        return $this;
    }
}