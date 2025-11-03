<?php

/**
 * @author      Nexaas Team <dev@nexaas.com>
 * @copyright   2025 Nexaas (http://www.nexxaas.com)
 * @license     http://www.nexaas.com  Copyright
 *
 * @link        http://www.nexaas.com
 *
 */

namespace Braspag\BraspagPagador\Api\Factories;

use GuzzleHttp\Client as HttpClient;

class HttpFactory
{
    /**
     * @param array $config
     * @return HttpClient
     */
    public static function make(array $config = [])
    {
        return new HttpClient($config);
    }
}