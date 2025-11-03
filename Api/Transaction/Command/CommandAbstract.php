<?php

/**
 * @author      Nexaas Team <dev@nexaas.com>
 * @copyright   2025 Nexaas (http://www.nexxaas.com)
 * @license     http://www.nexaas.com  Copyright
 *
 * @link        http://www.nexaas.com
 *
 */

namespace Braspag\BraspagPagador\Api\Transaction\Command;

use Braspag\BraspagPagador\Api\Transaction\Resource\RequestAbstract;
use Psr\Http\Message\ResponseInterface;

abstract class CommandAbstract
{
    protected $request;
    protected $result;

    abstract protected function execute();

    public function __construct(RequestAbstract $request)
    {
        $this->request = $request;
        $this->execute();
    }

    public function getResult()
    {
        return $this->result;
    }

    /**
     * @param ResponseInterface $response
     * @param bool $assoc
     * @param int $depth
     * @param int $options
     * @return array
     */
    public function getResponseToArray(ResponseInterface $response, $assoc = true, $depth = 512, $options = 0)
    {
        return \json_decode($response->getBody(), $assoc, $depth, $options);
    }
}