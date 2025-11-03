<?php

namespace Braspag\BraspagPagador\Gateway\Transaction\CreditCard\Resource\Capture\Request;

use Magento\Payment\Gateway\Response\HandlerInterface;
use Braspag\BraspagPagador\Gateway\Transaction\CreditCard\Resource\Capture\Request;
use Braspag\BraspagPagador\Gateway\Transaction\Base\Resource\Request\AbstractHandler;
use Braspag\BraspagPagador\Model\SplitManager;

/**

 * Braspag Transaction CreditCard Capture Response Handler
 *
 * @author      Nexaas Team <dev@nexaas.com>
 * @copyright   2025 Nexaas (http://www.nexxaas.com)
 * @license     http://www.nexaas.com  Copyright
 *
 * @link        http://www.nexaas.com
 */
class SplitHandler extends AbstractHandler implements HandlerInterface
{
    /**
     * @var
     */
    protected $session;

    /**
     * @var
     */
    protected $splitManager;

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
     * @return Braspag\BraspagPagador\Model\SplitManager
     */
    public function getSplitManager(): SplitManager
    {
        return $this->splitManager;
    }

    /**
     * @param Braspag\BraspagPagador\Model\SplitManager $splitManager
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

        $splitData = $request->getPaymentSplitRequest()->getSplits();

        $this->getSplitManager()->createPaymentSplitByOrder($payment->getOrder(), $splitData);

        return $request;
    }
}