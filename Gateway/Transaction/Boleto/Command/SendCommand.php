<?php

namespace Braspag\BraspagPagador\Gateway\Transaction\Boleto\Command;

use Braspag\BraspagPagador\Gateway\Transaction\Base\Command\AbstractApiCommand;
use Braspag\BraspagPagador\Api\Transaction\Api\Boleto\Send\RequestInterface;

/**
 * Braspag Transaction Boleto Send Command
 *
 * @author      Nexaas Team <dev@nexaas.com>
 * @copyright   2025 Nexaas (http://www.nexxaas.com)
 * @license     http://www.nexaas.com  Copyright
 *
 * @link        http://www.nexaas.com
 */
class SendCommand extends AbstractApiCommand
{
    protected function sendRequest($request)
    {
        if (!isset($request) || !$request instanceof RequestInterface) {
            throw new \InvalidArgumentException('Braspag Boleto Send Request Lib object should be provided');
        }

        return $this->getApi()->sendBoleto($request);
    }
}