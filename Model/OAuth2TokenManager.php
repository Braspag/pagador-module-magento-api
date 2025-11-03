<?php

/**
 * @author      Nexaas Core Team <dev@nexaas.com>
 * @copyright   2025 Nexaas (http://www.nexaas.com)
 * @license     http://www.nexaas.com  Copyright
 *
 * @link        http://www.nexaas.com
 */

namespace Braspag\BraspagPagador\Model;

use Braspag\BraspagPagador\Api\Transaction\Resource\OAuth2\Token\Response as OAuth2TokenResponse;
use Braspag\BraspagPagador\Api\OAuth2TokenManagerInterface;
use Braspag\BraspagPagador\Api\Transaction\Api;
use Braspag\BraspagPagador\Gateway\Transaction\OAuth2\Resource\Token\RequestInterface as OAuth2TokenRequest;
use Braspag\BraspagPagador\Api\Transaction\ApiInterface as BraspagApi;
use Braspag\BraspagPagador\Gateway\Transaction\OAuth2\Command\TokenCommand;
use Braspag\BraspagPagador\Gateway\Transaction\OAuth2\Resource\Token\BuilderInterface;
use Magento\Framework\DataObject;

class OAuth2TokenManager implements OAuth2TokenManagerInterface
{
    protected $request;
    protected $tokenCommand;
    protected $cookieManager;
    protected $cookieMetadataFactory;
    protected $builder;
    protected $dataObject;
    protected $tokenObject;

    /**
     * OAuth2TokenManager constructor.
     * @param OAuth2TokenRequest $request
     * @param BraspagApi $api
     * @param \Magento\Framework\Stdlib\CookieManagerInterface $cookieManager
     * @param \Magento\Framework\Stdlib\Cookie\CookieMetadataFactory $cookieMetadataFactory
     */
    public function __construct(
        OAuth2TokenRequest $request,
        TokenCommand $tokenCommand,
        \Magento\Framework\Stdlib\CookieManagerInterface $cookieManager,
        \Magento\Framework\Stdlib\Cookie\CookieMetadataFactory $cookieMetadataFactory,
        BuilderInterface $builder,
        DataObject $dataObject
    ) {
        $this->setTokenCommand($tokenCommand);
        $this->setRequest($request);
        $this->setCookieManager($cookieManager);
        $this->setCookieMetadataFactory($cookieMetadataFactory);
        $this->setBuilder($builder);
        $this->setDataObject($dataObject);
    }

    /**
     * @return OAuth2TokenRequest
     */
    protected function getRequest(): OAuth2TokenRequest
    {
        return $this->request;
    }

    /**
     * @param OAuth2TokenRequest $request
     */
    protected function setRequest(OAuth2TokenRequest $request)
    {
        $this->request = $request;
    }

    /**
     * @return TokenCommand
     */
    protected function getTokenCommand(): TokenCommand
    {
        return $this->tokenCommand;
    }

    /**
     * @param TokenCommand $tokenCommand
     */
    protected function setTokenCommand(TokenCommand $tokenCommand)
    {
        $this->tokenCommand = $tokenCommand;
    }

    /**
     * @return \Magento\Framework\Stdlib\CookieManagerInterface
     */
    protected function getCookieManager(): \Magento\Framework\Stdlib\CookieManagerInterface
    {
        return $this->cookieManager;
    }

    /**
     * @param \Magento\Framework\Stdlib\CookieManagerInterface $cookieManager
     */
    protected function setCookieManager(\Magento\Framework\Stdlib\CookieManagerInterface $cookieManager)
    {
        $this->cookieManager = $cookieManager;
    }

    /**
     * @return \Magento\Framework\Stdlib\Cookie\CookieMetadataFactory
     */
    protected function getCookieMetadataFactory(): \Magento\Framework\Stdlib\Cookie\CookieMetadataFactory
    {
        return $this->cookieMetadataFactory;
    }

    /**
     * @param \Magento\Framework\Stdlib\Cookie\CookieMetadataFactory $cookieMetadataFactory
     */
    protected function setCookieMetadataFactory(\Magento\Framework\Stdlib\Cookie\CookieMetadataFactory $cookieMetadataFactory)
    {
        $this->cookieMetadataFactory = $cookieMetadataFactory;
    }

    /**
     * @return BuilderInterface
     */
    protected function getBuilder(): BuilderInterface
    {
        return $this->builder;
    }

    /**
     * @param BuilderInterface $builder
     */
    protected function setBuilder(BuilderInterface $builder)
    {
        $this->builder = $builder;
    }

    /**
     * @return DataObject
     */
    protected function getDataObject(): DataObject
    {
        return $this->dataObject;
    }

    /**
     * @param DataObject $dataObject
     */
    protected function setDataObject(DataObject $dataObject)
    {
        $this->dataObject = $dataObject;
    }

    /**
     * @return mixed
     */
    protected function getTokenObject()
    {
        return $this->tokenObject;
    }

    /**
     * @param mixed $tokenObject
     */
    protected function setTokenObject($tokenObject)
    {
        $this->tokenObject = $tokenObject;
    }

    /**
     * @return array
     * @throws \Magento\Framework\Exception\InputException
     * @throws \Magento\Framework\Stdlib\Cookie\CookieSizeLimitReachedException
     * @throws \Magento\Framework\Stdlib\Cookie\FailureToSendException
     */
    public function getToken()
    {
        if (!$this->validateSavedTokenLife()) {
            $response = $this->getTokenCommand()->execute($this->getRequest());
            $this->setTokenObject($this->getBuilder()->build($response));
            $this->registerToken();
        }

        return $this->getSavedToken();
    }

    /**
     * @param OAuth2TokenResponse $authenticationResponse
     * @return $this
     * @throws \Magento\Framework\Exception\InputException
     * @throws \Magento\Framework\Stdlib\Cookie\CookieSizeLimitReachedException
     * @throws \Magento\Framework\Stdlib\Cookie\FailureToSendException
     */
    protected function registerToken()
    {
        $cookieMetadata = $this->getCookieMetadataFactory()->createPublicCookieMetadata()
            ->setHttpOnly(true)
            ->setDuration($this->getTokenObject()->getExpiresIn())
            ->setPath('/');

        $this->getCookieManager()->setPublicCookie(
            OAuth2TokenRequest::OAUTH2_ACCESS_TOKEN_COOKIE_NAME,
            $this->getTokenObject()->getToken(),
            $cookieMetadata
        );

        return $this;
    }

    protected function validateSavedTokenLife()
    {
        return (bool) $this->getCookieManager()->getCookie(OAuth2TokenRequest::OAUTH2_ACCESS_TOKEN_COOKIE_NAME, false);
    }

    protected function getSavedToken()
    {
        if ($this->getTokenObject() instanceof DataObject) {
            return $this->getTokenObject()->getToken();
        }

        return $this->getCookieManager()
            ->getCookie(OAuth2TokenRequest::OAUTH2_ACCESS_TOKEN_COOKIE_NAME, null);
    }
}