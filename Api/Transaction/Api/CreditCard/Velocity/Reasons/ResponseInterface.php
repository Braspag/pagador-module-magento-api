<?php

/**
 * @author      Nexaas Team <dev@nexaas.com>
 * @copyright   2025 Nexaas (http://www.nexxaas.com)
 * @license     http://www.nexaas.com  Copyright
 *
 * @link        http://www.nexaas.com
 *
 */

namespace Braspag\BraspagPagador\Api\Transaction\Api\CreditCard\Velocity\Reasons;

interface ResponseInterface
{
    public function getRuleId();

    public function getMessage();

    public function getHitsQuantity();

    public function getHitsTimeRangeInSeconds();

    public function getExpirationBlockTimeInSeconds();
}