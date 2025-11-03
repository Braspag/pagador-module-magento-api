<?php

/**
 * @author      Nexaas Team <dev@nexaas.com>
 * @copyright   2025 Nexaas (http://www.nexxaas.com)
 * @license     http://www.nexaas.com  Copyright
 *
 * @link        http://www.nexaas.com
 *
 */

namespace Braspag\BraspagPagador\Api\Transaction\Api\AntiFraud\Items;

interface RequestInterface
{
    public function getGiftCategory();

    public function getHostHedge();

    public function getNonSensicalHedge();

    public function getObscenitiesHedge();

    public function getPhoneHedge();

    public function getName();

    public function getQuantity();

    public function getSku();

    public function getUnitPrice();

    public function getRisk();

    public function getTimeHedge();

    public function getType();

    public function getVelocityHedge();

    public function getPassengerEmail();

    public function getPassengerIdentity();

    public function getPassengerName();

    public function getPassengerRating();

    public function getPassengerPhone();

    public function getPassengerStatus();
}