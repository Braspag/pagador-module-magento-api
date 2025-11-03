<?php

namespace Braspag\BraspagPagador\Api\Factories;

use Braspag\BraspagPagador\Api\Factories\HandlerFactoryInterface;

/**
 *
 *
 * @author      Nexaas Team <dev@nexaas.com>
 * @copyright   2025 Nexaas (http://www.nexxaas.com)
 * @license     http://www.nexaas.com  Copyright
 *
 * @link        http://www.nexaas.com
 */
class HandlerFactory implements HandlerFactoryInterface
{
    public static function make()
    {
        $stack = \GuzzleHttp\HandlerStack::create();

        $stack->push(\GuzzleHttp\Middleware::mapRequest(function (\Psr\Http\Message\RequestInterface $request) {
            \Braspag\BraspagPagador\Api\Factories\LoggerFactory::make($request);
            return $request;
        }), 'format_request_log');

        $stack->push(\GuzzleHttp\Middleware::mapResponse(function (\Psr\Http\Message\ResponseInterface $response) {
            \Braspag\BraspagPagador\Api\Factories\LoggerFactory::make($response);
            return $response;
        }), 'format_response_log');

        return $stack;
    }
}