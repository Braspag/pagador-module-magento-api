<?php

/**
 * @author      Nexaas Team <dev@nexaas.com>
 * @copyright   2025 Nexaas (http://www.nexxaas.com)
 * @license     http://www.nexaas.com  Copyright
 *
 * @link        http://www.nexaas.com
 *
 */

namespace Braspag\BraspagPagador\Api\Transaction\Resource\CreditCard\Velocity;

use Braspag\BraspagPagador\Api\Factories\ResponseFactory;
use Braspag\BraspagPagador\Api\Transaction\Api\CreditCard\Velocity\ResponseInterface;
use Braspag\BraspagPagador\Api\Transaction\Resource\ResponseAbstract;

class Response extends ResponseAbstract implements ResponseInterface
{
    public function getId()
    {
        if (! isset($this->response['Id'])) {
            return false;
        }
        return $this->response['Id'];
    }

    public function getResultMessage()
    {
        if (! isset($this->response['ResultMessage'])) {
            return false;
        }

        return $this->response['ResultMessage'];
    }

    public function getScore()
    {
        if (! isset($this->response['Score'])) {
            return false;
        }

        return $this->response['Score'];
    }

    public function getRejectReasons()
    {
        if (! isset($this->response['RejectReasons']) || ! is_array($this->response['RejectReasons'])) {
            return [];
        }

        $result = [];

        foreach ($this->response['RejectReasons'] as $reason) {
            $result[] = ResponseFactory::make($reason, 'velocityReasons');
        }

        return $result;
    }
}