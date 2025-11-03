<?php

/**
 * @author      Nexaas Core Team <dev@nexaas.com>
 * @copyright   2025 Nexaas (http://www.nexaas.com)
 * @license     http://www.nexaas.com  Copyright
 *
 * @link        http://www.nexaas.com
 */

namespace Braspag\BraspagPagador\Api;

/**
 * Interface NotificationManagementInterface
 * @package Braspag\BraspagPagador\Api
 */
interface NotificationManagementInterface
{
    /**
     * @api
     * @param string $PaymentId
     * @param int $ChangeType
     * @param string $RecurrentPaymentId
     * @return boolean
     */
    public function save($PaymentId, $ChangeType, $RecurrentPaymentId = '');
}