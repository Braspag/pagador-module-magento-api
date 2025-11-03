<?php

/**
 * @author      Nexaas Core Team <dev@nexaas.com>
 * @copyright   2025 Nexaas (http://www.nexaas.com)
 * @license     http://www.nexaas.com  Copyright
 *
 * @link        http://www.nexaas.com
 */

namespace Braspag\BraspagPagador\Api;

interface AntiFraudManagerInterface
{
    /**
     * @param string $customerId
     * @return mixed
     */
    public function getFingerPrintData($customerId);
}
