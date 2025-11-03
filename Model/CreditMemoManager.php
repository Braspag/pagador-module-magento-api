<?php

/**
 * @author      Nexaas Core Team <dev@nexaas.com>
 * @copyright   2025 Nexaas (http://www.nexaas.com)
 * @license     http://www.nexaas.com  Copyright
 *
 * @link        http://www.nexaas.com
 */

namespace Braspag\BraspagPagador\Model;

use Magento\Sales\Model\Order\CreditmemoFactory;
use Magento\Sales\Model\Service\CreditmemoService;

class CreditMemoManager
{
    /**
     * @var \Magento\Sales\Model\Order\CreditmemoFactory
     */
    protected $creditmemoFactory;

    /**
     * @var \Magento\Sales\Model\Service\CreditmemoService
     */
    protected $creditmemoService;

    public function __construct(
        CreditmemoFactory $creditmemoFactory,
        CreditmemoService $creditmemoService
    ) {
        $this->setCreditmemoFactory($creditmemoFactory);
        $this->setCreditmemoService($creditmemoService);
    }

    /**
     * @return mixed
     */
    public function getCreditmemoFactory()
    {
        return $this->creditmemoFactory;
    }

    /**
     * @param mixed $creditmemoFactory
     *
     * @return self
     */
    public function setCreditmemoFactory($creditmemoFactory)
    {
        $this->creditmemoFactory = $creditmemoFactory;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCreditmemoService()
    {
        return $this->creditmemoService;
    }

    /**
     * @param mixed $creditmemoService
     *
     * @return self
     */
    public function setCreditmemoService($creditmemoService)
    {
        $this->creditmemoService = $creditmemoService;

        return $this;
    }

    /**
     * @param $order
     * @return bool
     */
    public function createCreditMemo($order)
    {
        $creditmemo = $this->getCreditmemoFactory()->createByOrder($order);
        $this->getCreditmemoService()->refund($creditmemo, true);

        return true;
    }
}