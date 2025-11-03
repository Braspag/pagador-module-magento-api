<?php

/**
 * @author      Nexaas Team <dev@nexaas.com>
 * @copyright   2025 Nexaas (http://www.nexxaas.com)
 * @license     http://www.nexaas.com  Copyright
 *
 * @link        http://www.nexaas.com
 *
 */

namespace Braspag\BraspagPagador\Block\Payment\Info;

use Magento\Payment\Block\Info;
use Magento\Framework\DataObject;
use Magento\Framework\View\Element\Template\Context;
use Braspag\BraspagPagador\Model\Payment\Info\BoletoFactoryInterface;
use Braspag\BraspagPagador\Model\Payment\Info\BoletoFactory;

class Boleto extends Info
{
    const TEMPLATE = 'Braspag_BraspagPagador::payment/info/boleto.phtml';

    /** @var BoletoFactory */
    protected $boletoFactory;

    public function __construct(
        Context $context,
        BoletoFactoryInterface $boletoFactory,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->boletoFactory = $boletoFactory;
    }

    public function _construct()
    {
        $this->setTemplate(self::TEMPLATE);
    }

    /**
     * @param \Magento\Framework\DataObject|array|null $transport
     * @return \Magento\Framework\DataObject
     */
    protected function _prepareSpecificInformation($transport = null)
    {
        $boleto = $this->boletoFactory->create($this->getInfo()->getOrder());

        $transport = new DataObject([
            (string)__('Print Boleto') => $boleto->getBoletoUrl()
        ]);

        $transport = parent::_prepareSpecificInformation($transport);

        return $transport;
    }
}
