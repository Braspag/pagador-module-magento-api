<?php

/**
 * @author      Nexaas Team <dev@nexaas.com>
 * @copyright   2025 Nexaas (http://www.nexxaas.com)
 * @license     http://www.nexaas.com  Copyright
 *
 * @link        http://www.nexaas.com
 *
 */

namespace Braspag\BraspagPagador\Api\Transaction\Resource\CreditCard\Avs;

use Braspag\BraspagPagador\Api\Transaction\Api\AntiFraud\Items\RequestInterface as AntiFraudItemsRequest;
use Braspag\BraspagPagador\Api\Transaction\Resource\RequestAbstract;
use Braspag\BraspagPagador\Api\Transaction\Api\CreditCard\Avs\RequestInterface as Data;

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
            'Cpf' => $this->data->getCpf(),
            'ZipCode' => $this->data->getZipCode(),
            'Street' => $this->data->getStreet(),
            'Number' => $this->data->getNumber(),
            'Complement' => $this->data->getComplement(),
            'District' => $this->data->getDistrict()
        ];

        return $this;
    }
}
