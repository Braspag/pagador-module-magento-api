<?php

namespace Braspag\BraspagPagador\Model\Source;

/**
 * CC Types
 *
 * @author      Nexaas Team <dev@nexaas.com>
 * @copyright   2025 Nexaas (http://www.nexxaas.com)
 * @license     http://www.nexaas.com  Copyright
 *
 * @link        http://www.nexaas.com
 */

class Dctype extends \Magento\Payment\Model\Source\Cctype
{
    /**
     * @return array
     */
    public function getAllowedTypes()
    {
        return [
            'Simulado',
            'Cielo-Visa',
            'Cielo-Master',
            'Cielo30-Visa',
            'Cielo30-Master',
            'Cielo30-Elo',
            'Getnet-Visa',
            'Getnet-Master',
            'Rede2-Visa',
            'Rede2-Master',
            'FirstData-Visa',
            'FirstData-Master',
            'GlobalPayments-Visa',
            'GlobalPayments-Master'
        ];
    }
}