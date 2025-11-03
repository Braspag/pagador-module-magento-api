<?php

/**
 * @author      Nexaas Team <dev@nexaas.com>
 * @copyright   2025 Nexaas (http://www.nexxaas.com)
 * @license     http://www.nexaas.com  Copyright
 *
 * @link        http://www.nexaas.com
 *
 */

namespace Braspag\BraspagPagador\Api\Transaction\Resource\DebitCard\Send;

use Braspag\BraspagPagador\Api\Transaction\Resource\RequestAbstract;
use Braspag\BraspagPagador\Api\Transaction\Api\DebitCard\Send\RequestInterface as Data;
use Braspag\BraspagPagador\Api\Factories\AntiFraudRequestFactory;
use Braspag\BraspagPagador\Api\Factories\PaymentSplitRequestFactory;

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
        $this->params = [
            'headers' => [
                'Content-Type' => self::CONTENT_TYPE_APPLICATION_JSON,
                'MerchantId' => $this->data->getMerchantId(),
                'MerchantKey' => $this->data->getMerchantKey()
            ],
            'body' => [
                'MerchantOrderId' => $this->data->getMerchantOrderId(),
                'Customer' => [
                    'Name' => $this->data->getCustomerName(),
                ],

                'Payment' => [
                    'Type' => Data::PAYMENT_TYPE,
                    'Amount' => $this->data->getPaymentAmount(),
                    'Provider' => $this->data->getPaymentProvider(),
                    'ReturnUrl' => $this->data->getPaymentReturnUrl(),
                    'DebitCard' => $this->getDebitCardParams(),
                    'doSplit' => $this->data->getPaymentDoSplit(),
                    'Partner' => 'MAG',
                    'Authenticate' => true
                ]
            ]
        ];


        $paymentSplitRequest = $this->data->getPaymentSplitRequest();

        if ($paymentSplitRequest) {
            $splitData = PaymentSplitRequestFactory::make($paymentSplitRequest)->getParams();
            $this->params['body']['Payment']['SplitPayments'] = $splitData['body']['SplitPayments'];
            $this->params['body']['Payment']['SplitTransaction'] = $splitData['body']['SplitTransaction'];
        }

        if ($this->data->getPaymentAuthenticate()) {
            $this->params['body']['Payment']['externalAuthentication'] = $this->getExternalAuthenticationParams();
        }

        return $this;
    }

    protected function getDebitCardParams()
    {
        if ($this->data->getPaymentCreditSoptpaymenttoken()) {
            return [
                'paymentToken' => $this->data->getPaymentCreditSoptpaymenttoken(),
                'brand' => empty($this->data->getPaymentCreditCardBrand()) ? 'Visa' : $this->data->getPaymentCreditCardBrand(),
                'saveCard' => $this->data->getPaymentCreditCardSaveCard(),
            ];
        }

        return [
            'CardNumber' => $this->data->getPaymentDebitCardCardNumber(),
            'Holder' => $this->data->getPaymentDebitCardHolder(),
            'ExpirationDate' => $this->data->getPaymentDebitCardExpirationDate(),
            'SecurityCode' => $this->data->getPaymentDebitCardSecurityCode(),
            'Brand' => empty($this->data->getPaymentDebitCardBrand()) ? 'Visa' : $this->data->getPaymentDebitCardBrand(),
        ];
    }

    protected function getExternalAuthenticationParams()
    {
        return [
            "Cavv" => $this->data->getPaymentExternalAuthenticationCavv(),
            "Xid" => $this->data->getPaymentExternalAuthenticationXid(),
            "Eci" => $this->data->getPaymentExternalAuthenticationEci(),
            "Version" => $this->data->getPaymentCardExternalAuthenticationVersion(),
            "ReferenceID" => $this->data->getPaymentExternalAuthenticationReferenceId()
        ];
    }
}