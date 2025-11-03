<?php

/**
 * @author      Nexaas Team <dev@nexaas.com>
 * @copyright   2025 Nexaas (http://www.nexxaas.com)
 * @license     http://www.nexaas.com  Copyright
 *
 * @link        http://www.nexaas.com
 *
 */

namespace Braspag\BraspagPagador\Gateway\Transaction\AntiFraud\Resource\Items;

use Magento\Framework\Session\SessionManagerInterface;
use Magento\Sales\Api\Data\OrderItemInterface;
use Braspag\BraspagPagador\Api\Transaction\Api\AntiFraud\Items\RequestInterface as BraspaglibRequestInterface;

class Request implements BraspaglibRequestInterface
{
    protected $itemAdapter;
    protected $session;
    protected $quote;
    protected $storeId;

    public function __construct(OrderItemInterface $itemAdapter, SessionManagerInterface $session)
    {
        $this->setItemAdapter($itemAdapter);
        $this->setSession($session);
    }

    /**
     * @codeCoverageIgnore
     */
    public function getGiftCategory()
    {
    }

    /**
     * @codeCoverageIgnore
     */
    public function getHostHedge()
    {
    }

    /**
     * @codeCoverageIgnore
     */
    public function getNonSensicalHedge()
    {
    }

    /**
     * @codeCoverageIgnore
     */
    public function getObscenitiesHedge()
    {
    }

    /**
     * @codeCoverageIgnore
     */
    public function getPhoneHedge()
    {
    }

    public function getName()
    {
        return $this->getItemAdapter()->getName();
    }

    public function getQuantity()
    {
        return $this->getItemAdapter()->getQtyOrdered();
    }

    public function getSku()
    {
        return $this->getItemAdapter()->getSku();
    }

    public function getUnitPrice()
    {
        $price = $this->getItemAdapter()->getPrice();

        if (! $price && $this->getItemAdapter()->getParentItem()) {
            $price = $this->getItemAdapter()->getParentItem()->getPrice();
        }

        $amount = $price * 100;

        return str_replace('.', '', $amount);
    }

    /**
     * @codeCoverageIgnore
     */
    public function getRisk()
    {
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTimeHedge()
    {
    }

    /**
     * @codeCoverageIgnore
     */
    public function getType()
    {
    }

    /**
     * @codeCoverageIgnore
     */
    public function getVelocityHedge()
    {
    }

    /**
     * @codeCoverageIgnore
     */
    public function getPassengerEmail()
    {
    }

    /**
     * @codeCoverageIgnore
     */
    public function getPassengerIdentity()
    {
    }

    /**
     * @codeCoverageIgnore
     */
    public function getPassengerName()
    {
    }

    /**
     * @codeCoverageIgnore
     */
    public function getPassengerRating()
    {
    }

    /**
     * @codeCoverageIgnore
     */
    public function getPassengerPhone()
    {
    }

    /**
     * @codeCoverageIgnore
     */
    public function getPassengerStatus()
    {
    }

    /**
     * @return SessionManagerInterface
     * @codeCoverageIgnore
     */
    protected function getSession()
    {
        return $this->session;
    }

    /**
     * @param SessionManagerInterface $session
     */
    protected function setSession($session)
    {
        $this->session = $session;
    }

    /**
     * @param OrderItemInterface $itemAdapter
     * @return $this
     */
    public function setItemAdapter(OrderItemInterface $itemAdapter)
    {
        $this->itemAdapter = $itemAdapter;
        return $this;
    }

    /**
     * @return OrderItemInterface
     */
    public function getItemAdapter()
    {
        return $this->itemAdapter;
    }

    /**
     * @return \Magento\Quote\Model\Quote
     * @codeCoverageIgnore
     */
    protected function getQuote()
    {
        if (!$this->quote) {
            $this->quote = $this->getSession()->getQuote();
        }

        return $this->quote;
    }

    /**
     * @inheritDoc
     */
    public function setStoreId($storeId = null)
    {
        $this->storeId = $storeId;
    }

    /**
     * @inheritDoc
     */
    public function getStoreId()
    {
        return $this->storeId;
    }
}