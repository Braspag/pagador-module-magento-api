<?php

namespace Braspag\BraspagPagador\Gateway\Transaction\Voucher\Resource\Order;

use Magento\Framework\Exception\LocalizedException;
use Magento\Payment\Gateway\Data\Order\OrderAdapter;
use Braspag\BraspagPagador\Gateway\Transaction\Voucher\Config\ConfigInterface;
use Magento\Payment\Gateway\Data\PaymentDataObjectInterface;
use Magento\Payment\Gateway\Request\BuilderInterface;
use Braspag\BraspagPagador\Api\Transaction\Api\PaymentSplit\RequestInterface as RequestPaymentSplitLibInterface;
use Braspag\BraspagPagador\Gateway\Transaction\Voucher\Resource\Order\RequestFactory;
use Braspag\BraspagPagador\Gateway\Transaction\Base\Resource\RequestInterface as BaseRequestInterface;
use Magento\Quote\Model\Quote\ItemFactory;
use Magento\Quote\Model\QuoteFactory;
use Braspag\BraspagPagador\Model\Source\PaymentSplitType;

/**
 * Braspag Transaction DebitCard Send Request Builder
 *
 * @author      Nexaas Team <dev@nexaas.com>
 * @copyright   2025 Nexaas (http://www.nexxaas.com)
 * @license     http://www.nexaas.com  Copyright
 *
 * @link        http://www.nexaas.com
 */
class RequestBuilder implements BuilderInterface
{
    protected $requestFactory;
    protected $requestAntiFraud;
    protected $requestPaymentSplit;
    protected $orderRepository;
    protected $config;
    protected $quoteItemFactory;
    protected $quoteFactory;

    public function __construct(
        RequestFactory $requestFactory,
        RequestPaymentSplitLibInterface $requestPaymentSplit,
        ConfigInterface $config,
        QuoteFactory $quoteFactory,
        ItemFactory $quoteItemFactory
    ) {
        $this->setRequestFactory($requestFactory);
        $this->setPaymentSplitRequest($requestPaymentSplit);
        $this->setConfig($config);
        $this->setQuoteFactory($quoteFactory);
        $this->setQuoteItemFactory($quoteItemFactory);
    }

    public function build(array $buildSubject)
    {
        if (!isset($buildSubject['payment']) || !$buildSubject['payment'] instanceof PaymentDataObjectInterface) {
            throw new \InvalidArgumentException('Payment data object should be provided');
        }

        $request = $this->getRequestFactory()->create();

        $paymentDataObject = $buildSubject['payment'];
        $paymentData = $paymentDataObject->getPayment();

        /** @var OrderAdapter $orderAdapter */
        $orderAdapter = $paymentDataObject->getOrder();
        $quote = $this->getQuoteByOrderItem($orderAdapter);


        if (
            $this->getConfig()->isPaymentSplitActive()
            && $this->getConfig()->getPaymentSplitType() == PaymentSplitType::PAYMENT_SPLIT_TYPE_TRANSACTIONAL
        ) {
            $this->getRequestPaymentSplit()->setConfig($this->getConfig());
            $request->setPaymentSplitRequest($this->getRequestPaymentSplit());
        }

        $request->setOrderAdapter($orderAdapter);
        $request->setPaymentData($paymentData);
        $request->setQuote($quote);

        return $request;
    }

    protected function setRequestFactory(RequestFactory $requestFactory)
    {
        $this->requestFactory = $requestFactory;
        return $this;
    }

    protected function getRequestFactory()
    {
        return $this->requestFactory;
    }

    protected function setPaymentSplitRequest(RequestPaymentSplitLibInterface $requestPaymentSplit)
    {
        $this->requestPaymentSplit = $requestPaymentSplit;
        return $this;
    }

    protected function getRequestPaymentSplit()
    {
        return $this->requestPaymentSplit;
    }

    protected function setConfig(ConfigInterface $config)
    {
        $this->config = $config;
        return $this;
    }

    protected function getConfig()
    {
        return $this->config;
    }

    /**
     * @return QuoteFactory
     */
    public function getQuoteFactory()
    {
        return $this->quoteFactory;
    }

    /**
     * @param QuoteFactory $quoteFactory
     */
    public function setQuoteFactory($quoteFactory)
    {
        $this->quoteFactory = $quoteFactory;
    }

    /**
     * @return mixed
     */
    public function getQuoteItemFactory()
    {
        return $this->quoteItemFactory;
    }

    /**
     * @param mixed $quoteItemFactory
     */
    public function setQuoteItemFactory($quoteItemFactory)
    {
        $this->quoteItemFactory = $quoteItemFactory;
    }

    /**
     * @param $orderAdapter
     * @return \Magento\Quote\Model\Quote
     * @deprecated
     */
    protected function getQuoteByOrderItem($orderAdapter)
    {
        $quoteItemId = $this->getQuoteIdByFirstItem($orderAdapter);

        /** @var \Magento\Quote\Model\Quote\Item $quoteItem */
        $quoteItem = $this->getQuoteItemFactory()->create();

        $quoteItem->load($quoteItemId);
        $quoteId = $quoteItem->getQuoteId();
        $quote = $this->getQuoteFactory()->create()->load($quoteId);
        return $quote;
    }

    /**
     * @param $orderAdapter
     * @return mixed
     * @deprecated
     */
    protected function getQuoteIdByFirstItem($orderAdapter)
    {
        $items = $orderAdapter->getItems();
        $firstItem = array_pop($items);
        $quoteItemId = $firstItem->getQuoteItemId();
        return $quoteItemId;
    }


    /**
    * @return bool
    */
    public function hasCardTwo()
    {
        return false;
    }
}