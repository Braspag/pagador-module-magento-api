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

class BoletoTypes extends \Magento\Payment\Model\Source\Cctype
{
    /**
     * @return array
     */
    public function getAllowedTypes()
    {
        return [
            "Simulado",
            "BancoDoBrasil2",
            "BancoDoBrasil3",
            "Bradesco2",
            "Braspag",
            "Caixa2",
            "Citibank2",
            "Itau3",
            "Santander2"
        ];
    }
}