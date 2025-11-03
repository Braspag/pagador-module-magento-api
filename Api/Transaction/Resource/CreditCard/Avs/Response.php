<?php

/**
 * @author      Nexaas Team <dev@nexaas.com>
 * @copyright   2025 Nexaas (http://www.nexxaas.com)
 * @license     http://www.nexaas.com  Copyright
 *
 * @link        http://www.nexaas.com
 *
 */

namespace Braspag\BraspagPagador\Api\Transaction\Resource\CreditCard\Avs;

use Braspag\BraspagPagador\Api\Transaction\Api\CreditCard\Avs\ResponseInterface;
use Braspag\BraspagPagador\Api\Transaction\Resource\ResponseAbstract;

class Response extends ResponseAbstract implements ResponseInterface
{
    public function getStatus()
    {
        if (! isset($this->response['Status'])) {
            return false;
        }
        return $this->response['Status'];
    }

    public function getReturnCode()
    {
        if (! isset($this->response['ReturnCode'])) {
            return false;
        }
        return $this->response['ReturnCode'];
    }
}