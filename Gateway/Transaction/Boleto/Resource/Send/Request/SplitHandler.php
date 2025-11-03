<?php

namespace Braspag\BraspagPagador\Gateway\Transaction\Boleto\Resource\Send\Request;

use Magento\Payment\Gateway\Response\HandlerInterface;
use Braspag\BraspagPagador\Gateway\Transaction\Boleto\Resource\Send\Request;
use Braspag\BraspagPagador\Gateway\Transaction\Base\Resource\Request\AbstractHandler;
use Braspag\BraspagPagador\Model\SplitManager;

/**

 * Braspag Transaction CreditCard Authorize Response Handler
 *
 * @author      Nexaas Team <dev@nexaas.com>
 * @copyright   2025 Nexaas (http://www.nexxaas.com)
 * @license     http://www.nexaas.com  Copyright
 *
 * @link        http://www.nexaas.com
 */
class SplitHandler extends AbstractHandler implements HandlerInterface
{
    protected $splitManager;
    /**
     * @var
     */
    protected $session;

    public function __construct(
        SplitManager $splitManager,
        Request $request,
        \Magento\Checkout\Model\Session $session
    ) {
        $this->setSplitManager($splitManager);
        $this->setRequest($request);
        $this->setSession($session);
    }

    /**
     * @return Webjump\BraspagPagador\Model\SplitManager
     */
    public function getSplitManager(): SplitManager
    {
        return $this->splitManager;
    }

    /**
     * @param Webjump\BraspagPagador\Model\SplitManager $splitManager
     */
    public function setSplitManager(SplitManager $splitManager)
    {
        $this->splitManager = $splitManager;
    }

    /**
     * @return mixed
     */
    public function getSession()
    {
        return $this->session;
    }

    /**
     * @param mixed $session
     */
    public function setSession($session)
    {
        $this->session = $session;
    }

    /**
     * @param $payment
     * @param $request
     * @return $this
     */
    protected function _handle($payment, $request)
    {
        if (!$request->getPaymentSplitRequest()) {
            return $this;
        }

        $request->getPaymentSplitRequest()->prepareSplits();

        $request->getPaymentSplitRequest()->prepareSplitTransactionData();

        $splitData = $request->getPaymentSplitRequest()->getSplits();

        $quote = $this->getSession()->getQuote();

        $this->getSplitManager()->createPaymentSplitByQuote($quote, $splitData);

        return $request;
    }
}
