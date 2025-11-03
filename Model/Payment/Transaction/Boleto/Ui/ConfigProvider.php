<?php

namespace Braspag\BraspagPagador\Model\Payment\Transaction\Boleto\Ui;

use Magento\Checkout\Model\ConfigProviderInterface;
use Braspag\BraspagPagador\Gateway\Transaction\Boleto\Config\ConfigInterface as BoletoConfig;

/**
 * Braspag Transaction Boleto Send Command
 *
 * @author      Nexaas Team <dev@nexaas.com>
 * @copyright   2025 Nexaas (http://www.nexxaas.com)
 * @license     http://www.nexaas.com  Copyright
 *
 * @link        http://www.nexaas.com
 */
final class ConfigProvider implements ConfigProviderInterface
{
    const CODE = 'braspag_pagador_boleto';

    protected $boletoConfig;

    public function __construct(
        BoletoConfig $boletoConfig
    ) {
        $this->setBoletoConfig($boletoConfig);
    }

    public function getConfig()
    {
        return [
            'payment' => [
                self::CODE => [
                    'info' => [
                        'demonstrative' => $this->getBoletoConfig()->getPaymentDemonstrative(),
                    ]
                ]
            ]
        ];
    }


    protected function getBoletoConfig()
    {
        return $this->boletoConfig;
    }

    protected function setBoletoConfig(BoletoConfig $boletoConfig)
    {
        $this->boletoConfig = $boletoConfig;

        return $this;
    }
}