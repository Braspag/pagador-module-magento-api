<?php

/**
 * @author      Nexaas Team <dev@nexaas.com>
 * @copyright   2025 Nexaas (http://www.nexxaas.com)
 * @license     http://www.nexaas.com  Copyright
 *
 * @link        http://www.nexaas.com
 *
 */

namespace Braspag\BraspagPagador\Api\Transaction\Resource\Boleto\Send;

use Braspag\BraspagPagador\Api\Factories\ResponseFactory;
use Braspag\BraspagPagador\Api\Transaction\Api\Boleto\Send\ResponseInterface;
use Braspag\BraspagPagador\Api\Transaction\Resource\ResponseAbstract;

class Response extends ResponseAbstract implements ResponseInterface
{
    public function getPayment()
    {
        if (! isset($this->response['Payment'])) {
            return false;
        }
        return $this->response['Payment'];
    }

    public function getPaymentUrl()
    {
        if (! isset($this->response['Payment']['Url'])) {
            return false;
        }
        return $this->response['Payment']['Url'];
    }

    public function getPaymentBoletoNumber()
    {
        if (! isset($this->response['Payment']['BoletoNumber'])) {
            return false;
        }
        return $this->response['Payment']['BoletoNumber'];
    }

    public function getPaymentBarCodeNumber()
    {
        if (! isset($this->response['Payment']['BarCodeNumber'])) {
            return false;
        }
        return $this->response['Payment']['BarCodeNumber'];
    }

    public function getPaymentPaymentId()
    {
        if (! isset($this->response['Payment']['PaymentId'])) {
            return false;
        }
        return $this->response['Payment']['PaymentId'];
    }

    public function getPaymentReceivedDate()
    {
        if (! isset($this->response['Payment']['ReceivedDate'])) {
            return false;
        }
        return $this->response['Payment']['ReceivedDate'];
    }

    public function getPaymentReasonCode()
    {
        if (! isset($this->response['Payment']['ReasonCode'])) {
            return false;
        }
        return $this->response['Payment']['ReasonCode'];
    }

    public function getPaymentReasonMessage()
    {
        if (! isset($this->response['Payment']['ReasonMessage'])) {
            return false;
        }
        return $this->response['Payment']['ReasonMessage'];
    }

    public function getPaymentStatus()
    {
        if (! isset($this->response['Payment']['Status'])) {
            return false;
        }
        return $this->response['Payment']['Status'];
    }

    public function getPaymentLinks()
    {
        if (! isset($this->response['Payment']['Links'])) {
            return false;
        }
        return $this->response['Payment']['Links'];
    }

    public function getDigitableLine()
    {
        if (! isset($this->response['Payment']['DigitableLine'])) {
            return false;
        }
        return $this->response['Payment']['DigitableLine'];
    }

    public function getExpirationDate()
    {
        if (! isset($this->response['Payment']['ExpirationDate'])) {
            return false;
        }
        return $this->response['Payment']['ExpirationDate'];
    }


    /**
     * @return bool|\Braspag\BraspagPagador\Api\Transaction\Resource\CreditCard\Avs\Response|\Braspag\BraspagPagador\Api\Transaction\Resource\CreditCard\Velocity\Reasons\Response|\Braspag\BraspagPagador\Api\Transaction\Resource\CreditCard\Velocity\Response|\Braspag\BraspagPagador\Api\Transaction\Resource\PaymentSplit\Response
     */
    public function getPaymentSplitPayments()
    {
        if (! isset($this->response['Payment']['SplitTransaction'])) {
            return false;
        }

        if (! is_array($this->response['Payment']['SplitTransaction'])) {
            return false;
        }

        return ResponseFactory::make($this->response['Payment']['SplitTransaction'], 'boletoPaymentSplit');
    }
}