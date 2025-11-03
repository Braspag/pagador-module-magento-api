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

interface ServiceInterface
{
    public function getEndPoint();

    /**
     * @return RequestAbstract
     */
    public function getRequest();
}