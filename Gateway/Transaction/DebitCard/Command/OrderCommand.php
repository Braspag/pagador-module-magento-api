<?php

namespace Braspag\BraspagPagador\Gateway\Transaction\DebitCard\Command;

use Braspag\BraspagPagador\Gateway\Transaction\Base\Command\AbstractApiCommand;
use Braspag\BraspagPagador\Api\Transaction\Api\DebitCard\Send\RequestInterface;

/**
 * Braspag Transaction DebitCard Order Command
 *
 * @author      Nexaas Team <dev@nexaas.com>
 * @copyright   2025 Nexaas (http://www.nexxaas.com)
 * @license     http://www.nexaas.com  Copyright
 *
 * @link        http://www.nexaas.com
 */
class OrderCommand extends AbstractApiCommand
{
    protected function sendRequest($request)
    {
        if (!isset($request) || !$request instanceof RequestInterface) {
            throw new \InvalidArgumentException('Braspag Debitcard Order Request Lib object should be provided');
        }

        return $this->getApi()->sendDebit($request);
    }
}