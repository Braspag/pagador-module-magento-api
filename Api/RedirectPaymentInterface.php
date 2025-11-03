<?php

namespace Braspag\BraspagPagador\Api;

/**
 *
 *
 * @author      Nexaas Team <dev@nexaas.com>
 * @copyright   2025 Nexaas (http://www.nexxaas.com)
 * @license     http://www.nexaas.com  Copyright
 *
 * @link        http://www.nexaas.com
 */
interface RedirectPaymentInterface
{
    /**
     * @param string $orderId
     * @return string url
     */
    public function getLink($orderId);
}