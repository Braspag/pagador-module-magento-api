<?php

/**
 * @author      Nexaas Team <dev@nexaas.com>
 * @copyright   2025 Nexaas (http://www.nexxaas.com)
 * @license     http://www.nexaas.com  Copyright
 *
 * @link        http://www.nexaas.com
 *
 */

namespace Braspag\BraspagPagador\Api\Http\Services;

use Braspag\BraspagPagador\Api\Transaction\Resource\RequestAbstract;

abstract class ServiceAbstract
{
    protected $endPoint = '';
    protected $request;

    /**
     * @param RequestAbstract $request
     */
    public function __construct(RequestAbstract $request)
    {
        $this->request = $request;
    }

    /**
     * @return string
     */
    public function getEndPoint()
    {
        return $this->endPoint;
    }

    public function setEndPoint($endPoint)
    {
        $this->endPoint = $endPoint;
        return $this;
    }

    /**
     * @return RequestAbstract
     */
    public function getRequest()
    {
        return $this->request;
    }
}