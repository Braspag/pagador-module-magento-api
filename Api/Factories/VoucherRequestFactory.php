<?php

/**
 * Copyright (C) 2021 Signativa/FGP Desenvolvimento de Software
 *
 *  @author Esmerio Neto <esmerio.neto@signativa.com.br>
 *
 * SPDX-License-Identifier: Apache-2.0
 *
 */

namespace Braspag\BraspagPagador\Api\Factories;

use Braspag\BraspagPagador\Api\Transaction\Resource\Voucher\Send\Request;
use Braspag\BraspagPagador\Api\Transaction\Api\Voucher\Send\RequestInterface as Data;

class VoucherRequestFactory
{
    /**
     * @param Data $data
     * @return Request
     */
    public static function make(Data $data)
    {
        return new Request($data);
    }
}