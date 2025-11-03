<?php

/**
 * Capture Request
 *
 * @author      Nexaas Team <dev@nexaas.com>
 * @copyright   2025 Nexaas (http://www.nexxaas.com)
 * @license     http://www.nexaas.com  Copyright
 *
 * @link        http://www.nexaas.com
 */

namespace Braspag\BraspagPagador\Gateway\Transaction\PaymentSplit\Resource\GetSubordinate;

use Magento\Framework\Session\SessionManagerInterface;
use Braspag\BraspagPagador\Api\OAuth2TokenManagerInterface;
use Braspag\BraspagPagador\Api\Transaction\Api\PaymentSplit\GetSubordinate\RequestInterface as BraspaglibRequestInterface;

class Request implements BraspaglibRequestInterface
{
    protected $session;

    protected $storeId;

    protected $config;

    protected $oAuth2TokenManager;

    protected $subordinateId;

    protected $subordinateMerchantId;

    public function __construct(
        SessionManagerInterface $session,
        OAuth2TokenManagerInterface $oAuth2TokenManager
    ) {
        $this->setSession($session);
        $this->setOAuth2TokenManager($oAuth2TokenManager);
    }

    /**
     * @return SessionManagerInterface
     */
    protected function getSession()
    {
        return $this->session;
    }

    /**
     * @param SessionManagerInterface $session
     */
    protected function setSession(SessionManagerInterface $session)
    {
        $this->session = $session;
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

    /**
     * @return mixed
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * @param mixed $config
     */
    public function setConfig($config)
    {
        $this->config = $config;
    }

    /**
     * @return mixed
     */
    public function getOAuth2TokenManager()
    {
        return $this->oAuth2TokenManager;
    }

    /**
     * @param mixed $oAuth2TokenManager
     */
    public function setOAuth2TokenManager($oAuth2TokenManager)
    {
        $this->oAuth2TokenManager = $oAuth2TokenManager;
    }

    /**
     * @return mixed
     */
    public function getAccessToken()
    {
        return $this->getOAuth2TokenManager()->getToken();
    }

    /**
     * @return mixed
     */
    public function isTestEnvironment()
    {
        return $this->getConfig()->getIsTestEnvironment();
    }

    /**
     * @return mixed
     */
    public function getSubordinateId()
    {
        return $this->subordinateId;
    }

    /**
     * @param mixed $subordinateId
     */
    public function setSubordinateId($subordinateId)
    {
        $this->subordinateId = $subordinateId;
    }

    /**
     * @return mixed
     */
    public function getSubordinateMerchantId()
    {
        return $this->subordinateMerchantId;
    }

    /**
     * @param mixed $subordinateMerchantId
     */
    public function setSubordinateMerchantId($subordinateMerchantId)
    {
        $this->subordinateMerchantId = $subordinateMerchantId;
    }
}