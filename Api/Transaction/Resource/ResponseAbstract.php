<?php

/**
 * @author      Nexaas Team <dev@nexaas.com>
 * @copyright   2025 Nexaas (http://www.nexxaas.com)
 * @license     http://www.nexaas.com  Copyright
 *
 * @link        http://www.nexaas.com
 *
 */

namespace Braspag\BraspagPagador\Api\Transaction\Resource;

abstract class ResponseAbstract
{
    protected $response = [];

    /**
     * ResponseAbstract constructor.
     * @param array $response
     */
    public function __construct(array $response = [])
    {
        $this->response = $response;
    }
}