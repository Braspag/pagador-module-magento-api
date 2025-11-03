<?php

/**
 * @author      Nexaas Core Team <dev@nexaas.com>
 * @copyright   2025 Nexaas (http://www.nexaas.com)
 * @license     http://www.nexaas.com  Copyright
 *
 * @link        http://www.nexaas.com
 */

namespace Braspag\BraspagPagador\Api;

interface OAuth2TokenManagerInterface
{
    /**
     * @return mixed
     */
    public function getToken();
}