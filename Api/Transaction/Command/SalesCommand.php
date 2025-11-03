<?php

/**
 * @author      Nexaas Team <dev@nexaas.com>
 * @copyright   2025 Nexaas (http://www.nexxaas.com)
 * @license     http://www.nexaas.com  Copyright
 *
 * @link        http://www.nexaas.com
 *
 */

namespace Braspag\BraspagPagador\Api\Transaction\Command;

use Braspag\BraspagPagador\Api\Factories\ClientHttpFactory;
use Braspag\BraspagPagador\Api\Factories\ResponseFactory;
use Braspag\BraspagPagador\Api\Factories\SalesFactory;
use Braspag\BraspagPagador\Api\Transaction\Resource\Boleto\Send\Request as BoletoRequest;
use Braspag\BraspagPagador\Api\Transaction\Resource\Pix\Send\Request as PixRequest;
use Braspag\BraspagPagador\Api\Transaction\Resource\CreditCard\Send\Request as CreditCardRequest;
use Braspag\BraspagPagador\Api\Transaction\Resource\CreditCard\PaymentSplit\Request as SplitPaymentTransactionPostRequest;
use Braspag\BraspagPagador\Api\Transaction\Resource\DebitCard\Send\Request as DebitRequest;
use Braspag\BraspagPagador\Api\Transaction\Resource\Voucher\Send\Request as VoucherRequest;

class SalesCommand extends CommandAbstract
{
    protected function execute()
    {
        $sales = SalesFactory::make($this->request);
        $client = ClientHttpFactory::make();

        $isTestEnvironment =  (bool) $this->request->getData()->isTestEnvironment();

        $response = $client->request($sales, 'POST', '', $isTestEnvironment);

        $type = '';

        if ($this->request instanceof BoletoRequest) {
            $type = ResponseFactory::CLASS_TYPE_BOLETO;
        }

        if ($this->request instanceof CreditCardRequest) {
            $type = ResponseFactory::CLASS_TYPE_CREDIT_CARD;
        }

        if ($this->request instanceof SplitPaymentTransactionPostRequest) {
            $type = ResponseFactory::CLASS_TYPE_CREDIT_CART_PAYMENT_SPLIT;
        }

        if ($this->request instanceof DebitRequest) {
            $type = ResponseFactory::CLASS_TYPE_DEBIT_CARD;
        }

        if ($this->request instanceof PixRequest) {
            $type = ResponseFactory::CLASS_TYPE_PIX;
        }

        if ($this->request instanceof VoucherRequest) {
            $type = ResponseFactory::CLASS_TYPE_VOUCHER;
        }

        $this->result = ResponseFactory::make($this->getResponseToArray($response), $type);
    }
}