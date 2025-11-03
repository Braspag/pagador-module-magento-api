<?php

/**
 * @author      Nexaas Team <dev@nexaas.com>
 * @copyright   2025 Nexaas (http://www.nexxaas.com)
 * @license     http://www.nexaas.com  Copyright
 *
 * @link        http://www.nexaas.com
 *
 */

namespace Braspag\BraspagPagador\Api\Transaction\Resource\Actions;

use Braspag\BraspagPagador\Api\Factories\ResponseFactory;
use Braspag\BraspagPagador\Api\Transaction\Api\Actions\Capture\ResponseInterface;
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

    public function getReasonCode()
    {
        if (! isset($this->response['ReasonCode'])) {
            return false;
        }
        return $this->response['ReasonCode'];
    }

    public function getPaymentAuthenticate()
    {
        if (! isset($this->response['Authenticate'])) {
            return false;
        }
        return $this->response['Authenticate'];
    }

    public function getReasonMessage()
    {
        if (! isset($this->response['ReasonMessage'])) {
            return false;
        }
        return $this->response['ReasonMessage'];
    }

    public function getProviderReturnCode()
    {
        if (! isset($this->response['ProviderReturnCode'])) {
            return false;
        }
        return $this->response['ProviderReturnCode'];
    }

    public function getProviderReturnMessage()
    {
        if (! isset($this->response['ProviderReturnMessage'])) {
            return false;
        }
        return $this->response['ProviderReturnMessage'];
    }

    public function getLinks()
    {
        if (! isset($this->response['Links'])) {
            return false;
        }
        return $this->response['Links'];
    }

    public function getPaymentSplitPayments()
    {
        if (! isset($this->response['SplitPayments'])) {
            return false;
        }

        if (! is_array($this->response['SplitPayments'])) {
            return false;
        }

        return ResponseFactory::make($this->response['SplitPayments'], 'paymentSplit');
    }
}