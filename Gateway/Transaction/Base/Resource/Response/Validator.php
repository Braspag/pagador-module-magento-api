<?php

namespace Braspag\BraspagPagador\Gateway\Transaction\Base\Resource\Response;


/**
 * Validator
 *
 * @author      Nexaas Team <dev@nexaas.com>
 * @copyright   2019 Webjump (http://www.nexaas.com)
 * @license     http://www.nexaas.com  Copyright
 *
 * @link        http://www.nexaas.com
 */
class Validator 
{
    const NOTFINISHED = 0;
    const AUTHORIZED = 1;
    const PAYMENTCONFIRMED = 2;
    const DENIED = 3;
    const VOIDED = 10;
    const REFUNDED = 11;
    const PENDING = 12;
    const ABORTED = 13;
    const SCHEDULED = 20;

}