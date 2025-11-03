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

use Braspag\BraspagPagador\Api\Factories\PaymentSplitClientHttpFactory;
use Braspag\BraspagPagador\Api\Factories\ResponseFactory;
use Braspag\BraspagPagador\Api\Factories\PaymentSplitTransactionPostFactory;
use Braspag\BraspagPagador\Api\Transaction\Command\CommandAbstract;

/**
 * Class TokenCommand
 * @package Braspag\BraspagPagador\Api\Transaction\Command\Auth3Ds20
 */
class TransactionPostCommand extends CommandAbstract
{
    /**
     * @return $this
     */
    protected function execute()
    {
        $splitTransactionPost = PaymentSplitTransactionPostFactory::make($this->request);
        $client = PaymentSplitClientHttpFactory::make();

        $params = $this->request->getParams();
        $isTestEnvironment =  (bool) $this->request->getData()->isTestEnvironment();
        $orderTransactionId =  $this->request->getData()->getOrderTransactionId();

        $response = $client->request($splitTransactionPost, 'PUT', '', $isTestEnvironment);

        $this->result = ResponseFactory::make($this->getResponseToArray($response), 'paymentSplit');

        return $this;
    }
}