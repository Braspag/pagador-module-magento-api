<?php

namespace Braspag\BraspagPagador\Gateway\Transaction\CreditCard\Resource\Authorize\Response;

use Magento\Payment\Gateway\Response\HandlerInterface;
use Braspag\BraspagPagador\Api\Transaction\Api\CreditCard\Velocity\ResponseInterface as VelocityResponseInterface;
use Braspag\BraspagPagador\Api\Transaction\Api\CreditCard\Velocity\Reasons\ResponseInterface as VelocityReasonsResponseInterface;
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
class VelocityAnalysisHandler extends AbstractHandler implements HandlerInterface
{
    public function __construct(
        Response $response
    ) {
        $this->setResponse($response);
    }

    protected function _handle($payment, $response)
    {
        $velocityResponse = $response->getVelocityAnalysis();

        if (!$velocityResponse instanceof VelocityResponseInterface) {
            return $this;
        }

        $payment->setAdditionalInformation('braspag_pagador_velocity_id', $velocityResponse->getId());
        $payment->setAdditionalInformation('braspag_pagador_velocity_result_message', $velocityResponse->getResultMessage());
        $payment->setAdditionalInformation('braspag_pagador_velocity_score', $velocityResponse->getScore());

        $rejectReasons = $velocityResponse->getRejectReasons();

        if (!empty($rejectReasons)) {
            $payment->setAdditionalInformation('braspag_pagador_velocity_reject_reasons', $this->getRejectReasons($rejectReasons));
        }

        return $response;
    }

    protected function getRejectReasons($rejectReasons)
    {
        $reasons = [];

        /** @var VelocityReasonsResponseInterface $reason */
        foreach ($rejectReasons as $reason) {
            $reasons[] = [
                'rule_id' => $reason->getRuleId(),
                'message' => $reason->getMessage(),
                'hits_quantity' => $reason->getHitsQuantity(),
                'expiration_block_time_in_seconds' => $reason->getExpirationBlockTimeInSeconds()
            ];
        }

        return serialize($reasons);
    }
}
