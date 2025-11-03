<?php

/**
 * @author      Nexaas Team <dev@nexaas.com>
 * @copyright   2025 Nexaas (http://www.nexxaas.com)
 * @license     http://www.nexaas.com  Copyright
 *
 * @link        http://www.nexaas.com
 *
 */

namespace Braspag\BraspagPagador\Api\Transaction\Api\Actions;

use Braspag\BraspagPagador\Api\Transaction\Api\AuthRequestInterface;

interface RequestInterface extends AuthRequestInterface
{
    public function getPaymentId();

    public function getAdditionalRequest();
}