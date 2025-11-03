<?php

namespace Braspag\BraspagPagador\Api\Factories;

/**
 *
 *
 * @author      Nexaas Team <dev@nexaas.com>
 * @copyright   2025 Nexaas (http://www.nexxaas.com)
 * @license     http://www.nexaas.com  Copyright
 *
 * @link        http://www.nexaas.com
 */
interface LoggerFactoryInterface
{
    public static function make($message);

    public static function makeLogRequest(\Psr\Http\Message\RequestInterface $request);

    public static function makeLogResponse(\Psr\Http\Message\ResponseInterface $response);
}