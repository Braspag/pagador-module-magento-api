<?php

namespace Braspag\BraspagPagador\Model\Payment\Transaction\CreditCard\Ui;

use Magento\Checkout\Model\ConfigProviderInterface;
use Braspag\BraspagPagador\Gateway\Transaction\Base\Resource\Installments\BuilderInterface  as InstallmentsBuilder;
use Braspag\BraspagPagador\Model\Payment\Transaction\Base\Ui\AbstractInstallmentsConfigProvider;

/**
 * Braspag Transaction CreditCard Authorize Command
 *
 * @author      Nexaas Team <dev@nexaas.com>
 * @copyright   2025 Nexaas (http://www.nexxaas.com)
 * @license     http://www.nexaas.com  Copyright
 *
 * @link        http://www.nexaas.com
 */
final class InstallmentsConfigProvider extends AbstractInstallmentsConfigProvider implements ConfigProviderInterface
{
    const CODE = 'braspag_pagador_creditcard';
}