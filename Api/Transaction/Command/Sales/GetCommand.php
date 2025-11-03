<?php

/**
 * @author      Nexaas Team <dev@nexaas.com>
 * @copyright   2025 Nexaas (http://www.nexxaas.com)
 * @license     http://www.nexaas.com  Copyright
 *
 * @link        http://www.nexaas.com
 *
 */

namespace Braspag\BraspagPagador\Api\Transaction\Command\Sales;

use Braspag\BraspagPagador\Api\Factories\ClientHttpFactory;
use Braspag\BraspagPagador\Api\Factories\ResponseFactory;
use Braspag\BraspagPagador\Api\Factories\SalesFactory;
use Braspag\BraspagPagador\Api\Transaction\Command\CommandAbstract;
use Braspag\BraspagPagador\Api\Transaction\Api\CreditCard\Send\RequestInterface as CreditCardData;
use Braspag\BraspagPagador\Api\Transaction\Api\Boleto\Send\RequestInterface as BoletoCardData;
use Braspag\BraspagPagador\Api\Transaction\Api\DebitCard\Send\RequestInterface as DebitCardData;

class GetCommand extends CommandAbstract
{
    protected function execute()
    {
        $sales = SalesFactory::make($this->request);
        $client = ClientHttpFactory::make();

        $params = $this->request->getParams();
        $uriComplement = $params['uriComplement']['payment_id'];

        $isTestEnvironment =  (bool) $this->request->getData()->isTestEnvironment();

        $response = $client->request($sales, 'GET', $uriComplement, $isTestEnvironment);

        $type = '';
        if ($this->request->getType()) {
            $type = $this->request->getType();
        }

        $this->result = ResponseFactory::make($this->getResponseToArray($response), $type);
    }

    protected function getType(array $data)
    {
        $type = '';

        if ($data['Payment']['Type'] === CreditCardData::PAYMENT_TYPE) {
            $type = ResponseFactory::CLASS_TYPE_CREDIT_CARD;
        }

        if ($data['Payment']['Type'] === BoletoCardData::PAYMENT_TYPE) {
            $type = ResponseFactory::CLASS_TYPE_BOLETO;
        }

        if ($data['Payment']['Type'] === DebitCardData::PAYMENT_TYPE) {
            $type = ResponseFactory::CLASS_TYPE_DEBIT_CARD;
        }

        return $type;
    }
}