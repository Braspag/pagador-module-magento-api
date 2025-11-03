<?php

/**
 * @author      Nexaas Core Team <dev@nexaas.com>
 * @copyright   2020 Webjump (http://www.nexaas.com)
 * @license     http://www.nexaas.com  Copyright
 * @link        http://www.nexaas.com
 */

declare(strict_types=1);

namespace Braspag\BraspagPagador\Api;

use Braspag\BraspagPagador\Api\Data\Auth3DS20UserAccountInformationInterface;

/**
 * Interface Auth3DS20UserAccountInterface
 *
 * @package Braspag\BraspagPagador\Api
 */
interface Auth3DS20UserAccountInterface
{
    /**
     * @param \Magento\Quote\Api\Data\CartInterface $quote
     * @return Auth3DS20UserAccountInformationInterface
     */
    public function getUserAccount(\Magento\Quote\Api\Data\CartInterface $quote): Auth3DS20UserAccountInformationInterface;
}