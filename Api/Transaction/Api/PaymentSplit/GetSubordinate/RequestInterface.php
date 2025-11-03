<?php

/**
 * @author      Nexaas Team <dev@nexaas.com>
 * @copyright   2025 Nexaas (http://www.nexxaas.com)
 * @license     http://www.nexaas.com  Copyright
 *
 * @link        http://www.nexaas.com
 *
 */

namespace Braspag\BraspagPagador\Api\Transaction\Api\PaymentSplit\GetSubordinate;

interface RequestInterface
{
    /**
     * @return mixed
     */
    public function getSubordinateId();

    /**
     * @param mixed $subordinateId
     */
    public function setSubordinateId($subordinateId);

    /**
     * @return mixed
     */
    public function getSubordinateMerchantId();

    /**
     * @param mixed $subordinateMerchantId
     */
    public function setSubordinateMerchantId($subordinateMerchantId);
}