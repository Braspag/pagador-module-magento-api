<?php

/**
 * @author      Nexaas Team <dev@nexaas.com>
 * @copyright   2025 Nexaas (http://www.nexxaas.com)
 * @license     http://www.nexaas.com  Copyright
 *
 * @link        http://www.nexaas.com
 *
 */

namespace Braspag\BraspagPagador\Api\Transaction\Command\PaymentSplit;

use Braspag\BraspagPagador\Api\Factories\PaymentSplitOnboardingClientHttpFactory;
use Braspag\BraspagPagador\Api\Factories\ResponseFactory;
use Braspag\BraspagPagador\Api\Factories\PaymentSplitGetSubordinateFactory;
use Braspag\BraspagPagador\Api\Transaction\Command\CommandAbstract;

/**
 * Class GetSubordinateCommand
 * @package Braspag\BraspagPagador\Api\Transaction\Command\PaymentSplit
 */
class GetSubordinateCommand extends CommandAbstract
{
    /**
     * @return $this
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function execute()
    {
        $getSubordinate = PaymentSplitGetSubordinateFactory::make($this->request);
        $client = PaymentSplitOnboardingClientHttpFactory::make();

        $isTestEnvironment =  (bool) $this->request->getData()->isTestEnvironment();

        $response = $client->request($getSubordinate, 'GET', '', $isTestEnvironment);

        $this->result = ResponseFactory::make($this->getResponseToArray($response), 'paymentSplitGetSubordinate');

        return $this;
    }
}