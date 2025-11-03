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

use Braspag\BraspagPagador\Api\Http\Client\PaymentSplitClient as ClientHttp;

class PaymentSplitClientHttpFactory
{
    /**
     * @return ClientHttp
     */
    public static function make()
    {
        return new ClientHttp();
    }
}