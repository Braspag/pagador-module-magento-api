<?php

namespace Braspag\BraspagPagador\Model\Source;

/**
 *
 * @author      Nexaas Team <dev@nexaas.com>
 * @copyright   2021 Webjump (http://www.nexaas.com)
 * @license     http://www.nexaas.com  Copyright
 *
 * @link        http://www.nexaas.com
 */

/**
 * Class BraspagPaymentMethods
 * @package Braspag\BraspagPagador\Model\Source
 */
class BraspagPaymentMethods implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * @return array
     */
    public function toOptionArray()
    {
        $options = [];

        foreach ($this->getPaymentMethods() as $code => $name) {
            $options[] = ['value' => $code, 'label' => $name];
        }

        return $options;
    }

    /**
     * @return array
     */
    public function getPaymentMethods()
    {
        return [
            'braspag_pagador_creditcard' => __('Braspag Pagador Credit Card'),
            'braspag_pagador_creditcardtoken' => __('Braspag Pagador Credit Card JustClick (Token)'),
            'braspag_pagador_boleto' => __('Braspag Pagador Boleto'),
            'braspag_pagador_debitcard' => __('Braspag Pagador Debit Card')
        ];
    }
}