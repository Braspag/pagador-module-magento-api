<?php

/**
 * @author      Nexaas Team <dev@nexaas.com>
 * @copyright   2025 Nexaas (http://www.nexxaas.com)
 * @license     http://www.nexaas.com  Copyright
 *
 * @link        http://www.nexaas.com
 *
 */

namespace Braspag\BraspagPagador\Api\Http\Client;

use Braspag\BraspagPagador\Api\Factories\HttpFactory as HttpClient;
use Braspag\BraspagPagador\Api\Http\Services\ServiceInterface;
use Braspag\BraspagPagador\Api\Factories\HandlerFactory;

class PaymentSplitOnboardingClient implements ClientInterface
{
    protected $client;

    protected $handler;

    /**
     * Client constructor.
     */
    public function __construct()
    {
        $this->client = HttpClient::make();
        $this->handler = HandlerFactory::make();
    }

    /**
     * @param ServiceInterface $service
     * @param string $method
     * @param string $uriComplement
     * @param bool $isTestEnvironment
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function request(
        ServiceInterface $service,
        $method = 'POST',
        $uriComplement = '',
        $isTestEnvironment = false
    ) {
        $params = $service->getRequest()->getParams();

        $apiURI = self::API_URI_PAYMENT_SPLIT_ONBOARDING;

        if ($isTestEnvironment === true) {
            $apiURI = self::API_URI_PAYMENT_SPLIT_ONBOARDING_TEST;
        }

        $uri = $apiURI . $service->getEndPoint() . $uriComplement;

        $headers = isset($params['headers']) ? $params['headers'] : [];
        $body = isset($params['body']) ? $params['body'] : [];

        return $this->client->request(
            $method,
            $uri,
            [
                'headers' => $headers,
                'body' => \json_encode($body),
                'handler' => $this->handler
            ]
        );
    }

    public function getClient()
    {
        return $this->client;
    }
}