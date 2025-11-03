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
interface NotificationManagerInterface
{
    const NOTIFICATION_PAYMENT_STATUS_CHANGED            = 1;
    const NOTIFICATION_RECURRENCE_CREATED                = 2;
    const NOTIFICATION_ANTI_FRAUD_STATUS_CHANGED         = 3;
    const NOTIFICATION_RECURRENCE_PAYMENT_STATUS_CHANGED = 4;
    const NOTIFICATION_REFUND_DENIED                     = 5;

    const ANTIFRAUD_STATUS_REVIEW                     = 'Review';
    const ANTIFRAUD_STATUS_ACCEPT                     = 'Accept';
    const ANTIFRAUD_STATUS_REJECT                     = 'Reject';
    const ANTIFRAUD_STATUS_PENDENT                    = 'Pendent';
    const ANTIFRAUD_STATUS_UNFINISHED                 = 'Unfinished';
    const ANTIFRAUD_STATUS_PROVIDERERROR              = 'ProviderError';

    /**
     * @param string $PaymentId
     * @param int $ChangeType
     * @param string $RecurrentPaymentId
     * @return boolean
     */
    public function save($PaymentId, $ChangeType, $RecurrentPaymentId = '');
}