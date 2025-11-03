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
use Braspag\BraspagPagador\Api\Factories\PaymentSplitLockFactory;
use Braspag\BraspagPagador\Api\Transaction\Command\CommandAbstract;

/**
 * Class LockCommand
 * @package Braspag\BraspagPagador\Api\Transaction\Command\PaymentSplit
 */
class LockCommand extends CommandAbstract
{
    /**
     * @return $this
     */
    protected function execute()
    {
        $splitLock = PaymentSplitLockFactory::make($this->request);
        $client = PaymentSplitClientHttpFactory::make();

        $params = $this->request->getParams();
        $isTestEnvironment =  (bool) $this->request->getData()->isTestEnvironment();
        $orderTransactionId =  $this->request->getData()->getOrderTransactionId();

        $response = $client->request($splitLock, 'PUT', '', $isTestEnvironment);

        $this->result = ResponseFactory::make($this->getResponseToArray($response), 'paymentSplitLock');

        return $this;
    }
}