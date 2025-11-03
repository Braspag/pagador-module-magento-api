<?php

/**
 * @author      Nexaas Team <dev@nexaas.com>
 * @copyright   2025 Nexaas (http://www.nexxaas.com)
 * @license     http://www.nexaas.com  Copyright
 *
 * @link        http://www.nexaas.com
 *
 */

namespace Braspag\BraspagPagador\Model\Source;

class BoletoBanks implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * @return array
     */
    public function toOptionArray()
    {
        return [
            "BancoDoBrasil" => 'BancoDoBrasil',
            "BankofAmerica" => 'BankofAmerica',
            "Bradesco" => 'Bradesco',
            "Caixa" => 'Caixa',
            "Citibank" => 'Citibank',
            "Itau" => 'Itau',
            "ItauShopline" => 'ItauShopline',
            "Santander" => 'Santander',
        ];
    }
}