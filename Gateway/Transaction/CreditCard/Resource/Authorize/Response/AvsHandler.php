<?php

namespace Braspag\BraspagPagador\Gateway\Transaction\CreditCard\Resource\Authorize\Response;

use Magento\Payment\Gateway\Response\HandlerInterface;
use Braspag\BraspagPagador\Api\Transaction\Api\CreditCard\Avs\ResponseInterface as AvsResponseInterface;
use Braspag\BraspagPagador\Api\Transaction\Resource\CreditCard\Send\Response;
use Braspag\BraspagPagador\Gateway\Transaction\Base\Resource\Response\AbstractHandler;

/**

 * Braspag Transaction CreditCard Authorize Response Handler
 *
 * @author      Nexaas Team <dev@nexaas.com>
 * @copyright   2025 Nexaas (http://www.nexxaas.com)
 * @license     http://www.nexaas.com  Copyright
 *
 * @link        http://www.nexaas.com
 */
class AvsHandler extends AbstractHandler implements HandlerInterface
{
    public function __construct(
        Response $response
    ) {
        $this->setResponse($response);
    }

    protected function _handle($payment, $response)
    {
        $avsResponse = $response->getAvs();

        if ($avsResponse instanceof AvsResponseInterface) {
            $payment->setAdditionalInformation('braspag_pagador_avs_status', $avsResponse->getStatus());
            $payment->setAdditionalInformation('braspag_pagador_avs_return_code', $avsResponse->getReturnCode());
        }

        return $response;
    }
}
