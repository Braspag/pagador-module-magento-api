<?php

/**
 * @author      Nexaas Core Team <dev@nexaas.com>
 * @copyright   2025 Nexaas (http://www.nexaas.com)
 * @license     http://www.nexaas.com  Copyright
 *
 * @link        http://www.nexaas.com
 */

namespace Braspag\BraspagPagador\Api;

use Braspag\BraspagPagador\Api\Data\SplitInterface;

interface SplitManagerInterface
{
    const DEFAULT_TIME_FROM_TO_SEND_TRANSACTIONAL_POST = '00:00:00';
    const DEFAULT_TIME_TO_TO_SEND_TRANSACTIONAL_POST = '01:30:00';
}