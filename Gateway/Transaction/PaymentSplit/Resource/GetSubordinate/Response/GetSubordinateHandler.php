<?php

namespace Braspag\BraspagPagador\Gateway\Transaction\PaymentSplit\Resource\GetSubordinate\Response;

use Magento\Payment\Gateway\Response\HandlerInterface;
use Braspag\BraspagPagador\Api\Transaction\Resource\PaymentSplit\GetSubordinate\Response;
use Braspag\BraspagPagador\Gateway\Transaction\Base\Resource\Response\AbstractHandler;
use Braspag\BraspagPagador\Model\SplitManager;
use Braspag\BraspagPagador\Model\SplitDataAdapter;

/**

 * Braspag Transaction Response Handler
 *
 * @author      Nexaas Team <dev@nexaas.com>
 * @copyright   2025 Nexaas (http://www.nexxaas.com)
 * @license     http://www.nexaas.com  Copyright
 *
 * @link        http://www.nexaas.com
 */
class GetSubordinateHandler extends AbstractHandler implements HandlerInterface
{
    protected $splitManager;

    /**
     * @var
     */
    protected $splitAdapter;

    public function __construct(
        SplitManager $splitManager,
        Response $response,
        SplitDataAdapter $splitAdapter
    ) {
        $this->setSplitManager($splitManager);
        $this->setResponse($response);
        $this->setSplitAdapter($splitAdapter);
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
    public function getObjectFactory()
    {
        return $this->objectFactory;
    }

    /**
     * @param mixed $objectFactory
     */
    public function setObjectFactory($objectFactory)
    {
        $this->objectFactory = $objectFactory;
    }

    /**
     * @return mixed
     */
    public function getSplitAdapter()
    {
        return $this->splitAdapter;
    }

    /**
     * @param mixed $splitAdapter
     */
    public function setSplitAdapter($splitAdapter)
    {
        $this->splitAdapter = $splitAdapter;
    }

    /**
     * @param array $handlingSubject
     * @param array $response
     * @return array|mixed|void|\Braspag\BraspagPagador\Gateway\Transaction\Base\Resource\Response\ResponseInterface|GetSubordinateHandler
     */
    public function handle(array $handlingSubject, array $response)
    {
        if (!isset($response['response']) || !$response['response'] instanceof $this->response) {
            throw new \InvalidArgumentException('Braspag Response Lib object should be provided');
        }

        $response = $response['response'];

        $handlingSubject = $handlingSubject['subordinate'];
        $response = $this->_handle($handlingSubject, $response);

        return $response;
    }

    /**,
     * @param $handlingSubject
     * @param $response
     * @return $this
     */
    protected function _handle($handlingSubject, $response)
    {
        if (!$response) {
            return $this;
        }

        return $response;
    }
}