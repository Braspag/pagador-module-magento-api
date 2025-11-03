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
 * Interface SubordinateApprovalNotificationManagerInterface
 * @package Braspag\BraspagPagador\Api
 */
interface SubordinateApprovalNotificationManagerInterface
{
    const NOTIFICATION_SELLER_APPROVAL_STATUS_APPROVED = 'Approved';
    const NOTIFICATION_SELLER_APPROVAL_STATUS_APPROVED_WITH_RESTRICTION = 'ApprovedWithRestriction';
    const NOTIFICATION_SELLER_APPROVAL_STATUS_REJECTED = 'Rejected';

    /**
     * @param string $MerchantId
     * @param string $Status
     * @param int $Score
     * @param string $DenialReason
     * @return boolean
     */
    public function save($MerchantId, $Status, $Score, $DenialReason = null);
}