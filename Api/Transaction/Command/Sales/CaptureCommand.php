<?php

/**
 * @author      Nexaas Team <dev@nexaas.com>
 * @copyright   2025 Nexaas (http://www.nexxaas.com)
 * @license     http://www.nexaas.com  Copyright
 *
 * @link        http://www.nexaas.com
 *
 */

namespace Braspag\BraspagPagador\Api\Transaction\Command\Sales;

use Braspag\BraspagPagador\Api\Factories\ClientHttpFactory;
use Braspag\BraspagPagador\Api\Factories\ResponseFactory;
use Braspag\BraspagPagador\Api\Factories\SalesFactory;
use Braspag\BraspagPagador\Api\Transaction\Command\CommandAbstract;

class CaptureCommand extends CommandAbstract
{
    protected function execute()
    {
        $sales = SalesFactory::make($this->request);
        $client = ClientHttpFactory::make();

        $params = $this->request->getParams();
        $uriComplement = sprintf('%s/capture/', $params['uriComplement']['payment_id']);

        if (isset($params['uriComplement']['additional'])) {
            $uriComplement .= '?' . \http_build_query($params['uriComplement']['additional']);
        }

        $isTestEnvironment =  (bool) $this->request->getData()->isTestEnvironment();

        $response = $client->request($sales, 'PUT', $uriComplement, $isTestEnvironment);

        $this->result = ResponseFactory::make($this->getResponseToArray($response), 'actions');
    }
}