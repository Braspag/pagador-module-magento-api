<?php

/**
 * @author      Nexaas Core Team <dev@nexaas.com>
 * @copyright   2025 Nexaas (http://www.nexaas.com)
 * @license     http://www.nexaas.com  Copyright
 *
 * @link        http://www.nexaas.com
 */

namespace Braspag\BraspagPagador\Api;

use Braspag\BraspagPagador\Api\Data\CardTokenInterface;

interface CardTokenManagerInterface
{
    public function registerCardToken($customerId, $paymentMethod, $response);

    /**
     * @param $cardToken
     *
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function disable(CardTokenInterface $cardToken);
}