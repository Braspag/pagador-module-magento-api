<?php

/**
 * @author      Nexaas Core Team <dev@nexaas.com>
 * @copyright   2020 Webjump (http://www.nexaas.com)
 * @license     http://www.nexaas.com  Copyright
 * @link        http://www.nexaas.com
 */

declare(strict_types=1);

namespace Braspag\BraspagPagador\Api;

use Braspag\BraspagPagador\Api\Data\Auth3DS20AddressInformationInterface;

/**
 * Interface Auth3DS20GetAddressInterface
 *
 * @package Braspag\BraspagPagador\Api
 */
interface Auth3DS20GetAddressInterface
{
    /**
     * @param \Magento\Quote\Api\Data\CartInterface $quote
     * @return Auth3DS20AddressInformationInterface
     */
    public function getAddressData(\Magento\Quote\Api\Data\CartInterface $quote): Auth3DS20AddressInformationInterface;
}
