<?php

/**
 * @author      Nexaas Team <dev@nexaas.com>
 * @copyright   2025 Nexaas (http://www.nexxaas.com)
 * @license     http://www.nexaas.com  Copyright
 *
 * @link        http://www.nexaas.com
 *
 */

namespace Braspag\BraspagPagador\Api\Transaction\Api\CreditCard\Avs;

interface RequestInterface
{
    public function getCpf();

    public function getZipCode();

    public function getStreet();

    public function getNumber();

    public function getComplement();

    public function getDistrict();
}