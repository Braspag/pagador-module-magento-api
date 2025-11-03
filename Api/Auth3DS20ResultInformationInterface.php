<?php

/**
 * @author      Nexaas Core Team <dev@nexaas.com>
 * @copyright   2020 Webjump (http://www.nexaas.com)
 * @license     http://www.nexaas.com  Copyright
 * @link        http://www.nexaas.com
 */

declare(strict_types=1);

namespace Braspag\BraspagPagador\Api;

use Braspag\BraspagPagador\Api\Data\Auth3DS20InformationInterface;

/**
 * Interface Auth3DS20ResultInformationInterface
 *
 * @package Braspag\BraspagPagador\Api
 */
interface Auth3DS20ResultInformationInterface
{
    /**
     * @param int $cartId
     * @return \Braspag\BraspagPagador\Api\Data\Auth3DS20InformationInterface
     */
    public function getInformation(int $cartId): Auth3DS20InformationInterface;
}