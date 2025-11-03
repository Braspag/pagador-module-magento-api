<?php

/**
 * @author      Nexaas Core Team <dev@nexaas.com>
 * @copyright   2025 Nexaas (http://www.nexaas.com)
 * @license     http://www.nexaas.com  Copyright
 *
 * @link        http://www.nexaas.com
 */

namespace Braspag\BraspagPagador\Gateway\Transaction\Base\Resource\PaymentStatus;

use Braspag\BraspagPagador\Api\Transaction\Api\Actions\RequestInterface as BraspaglibRequestInterface;

interface RequestInterface extends BraspaglibRequestInterface
{
    /**
     * @param string $paymentId
     */
    public function setPaymentId(string $paymentId);

    /**
     * @return string
     */
    public function getPaymentId(): string;

    /**
     * @param integer $storeId
     */
    public function setStoreId($storeId = null);

    /**
     * @return mixed
     */
    public function getStoreId();
}