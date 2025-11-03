<?php

/**
 * @author      Nexaas Team <dev@nexaas.com>
 * @copyright   2025 Nexaas (http://www.nexxaas.com)
 * @license     http://www.nexaas.com  Copyright
 *
 * @link        http://www.nexaas.com
 *
 */

namespace Braspag\BraspagPagador\Api\Transaction\Resource\CreditCard\Velocity\Reasons;

use Braspag\BraspagPagador\Api\Transaction\Api\CreditCard\Velocity\Reasons\ResponseInterface;
use Braspag\BraspagPagador\Api\Transaction\Resource\ResponseAbstract;

class Response extends ResponseAbstract implements ResponseInterface
{
    public function getRuleId()
    {
        if (! isset($this->response['RuleId'])) {
            return false;
        }

        return $this->response['RuleId'];
    }

    public function getMessage()
    {
        if (! isset($this->response['Message'])) {
            return false;
        }

        return $this->response['Message'];
    }

    public function getHitsQuantity()
    {
        if (! isset($this->response['HitsQuantity'])) {
            return false;
        }

        return $this->response['HitsQuantity'];
    }

    public function getHitsTimeRangeInSeconds()
    {
        if (! isset($this->response['HitsTimeRangeInSeconds'])) {
            return false;
        }

        return $this->response['HitsTimeRangeInSeconds'];
    }

    public function getExpirationBlockTimeInSeconds()
    {
        if (! isset($this->response['ExpirationBlockTimeInSeconds'])) {
            return false;
        }

        return $this->response['ExpirationBlockTimeInSeconds'];
    }
}