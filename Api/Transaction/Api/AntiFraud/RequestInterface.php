<?php

/**
 * @author      Nexaas Team <dev@nexaas.com>
 * @copyright   2025 Nexaas (http://www.nexxaas.com)
 * @license     http://www.nexaas.com  Copyright
 *
 * @link        http://www.nexaas.com
 *
 */

namespace Braspag\BraspagPagador\Api\Transaction\Api\AntiFraud;

interface RequestInterface
{
    public function getSequence();

    public function getSequenceCriteria();

    public function getFingerPrintId();

    public function getCaptureOnLowRisk();

    public function getVoidOnHighRisk();

    public function getBrowserCookiesAccepted();

    public function getBrowserEmail();

    public function getBrowserHostName();

    public function getBrowserIpAddress();

    public function getBrowserType();

    public function getCartIsGift();

    public function getCartReturnsAccepted();

    public function getCartItems();

    public function getMerchantDefinedFields();

    public function getCartShippingAddressee();

    public function getCartShippingMethod();

    public function getCartShippingPhone();

    public function getTotalOrderAmount();
}