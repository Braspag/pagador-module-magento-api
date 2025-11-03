<?php

/**
 * @author      Nexaas Team <dev@nexaas.com>
 * @copyright   2025 Nexaas (http://www.nexxaas.com)
 * @license     http://www.nexaas.com  Copyright
 *
 * @link        http://www.nexaas.com
 *
 */

namespace Braspag\BraspagPagador\Api\Transaction\Resource\PaymentSplit;

use Braspag\BraspagPagador\Api\Transaction\Resource\RequestAbstract;
use Braspag\BraspagPagador\Api\Transaction\Api\PaymentSplit\RequestInterface as Data;

class Request extends RequestAbstract
{
    /**
     * @param Data $data
     */
    public function __construct(Data $data)
    {
        $this->data = $data;
        $this->prepareParams();
    }

    /**
     * @return $this
     */
    protected function prepareParams()
    {
        $splits = $this->data->getSplits();

        $subordinates = [];
        foreach ($splits->getSubordinates() as $subordinate) {
            $subordinateData =  [
                "SubordinateMerchantId" => $subordinate['subordinate_merchant_id'],
                "Amount" => $subordinate['amount'],
                "Fares" => []
            ];

            if (isset($subordinate['fares'])) {
                if (!empty($subordinate['fares']['mdr'])) {
                    $subordinateData["Fares"]['Mdr'] = $subordinate['fares']['mdr'];
                }

                if (!empty($subordinate['fares']['fee'])) {
                    $subordinateData["Fares"]['Fee'] = $subordinate['fares']['fee'];
                }
            }

            if (empty($subordinateData["Fares"])) {
                unset($subordinateData["Fares"]);
            }

            $subordinates[] = $subordinateData;
        }

        if (!empty($this->data->getOrderTransactionId())) {
            $this->params['headers'] = [
                'Content-Type' => "application/json",
                'Authorization' => "Bearer " . $this->data->getAccessToken(),
            ];

            $this->params['orderPaymentTransactionId'] = $this->data->getOrderTransactionId();
        }

        $this->params['body'] = [
            'SplitPayments' => $subordinates,
            'SplitTransaction' => $this->data->getSplitTransaction()
        ];

        return $this;
    }
}