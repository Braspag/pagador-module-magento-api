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

class OAuth2Client implements ClientInterface
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
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function request(
        ServiceInterface $service,
        $method = 'POST',
        $uriComplement = '',
        $isTestEnvironment = false
    ) {
        $params = $service->getRequest()->getParams();

        $apiURI = self::API_URI_OAUTH2;

        if ($isTestEnvironment === true) {
            $apiURI = self::API_URI_OAUTH2_TEST;
        }

        $uri = $apiURI . $service->getEndPoint() . $uriComplement;

        $headers = isset($params['headers']) ? $params['headers'] : [];
        $body = isset($params['body']) ? $params['body'] : [];
        $formParms = isset($params['form_params']) ? $params['form_params'] : [];

        return $this->client->request(
            $method,
            $uri,
            [
                'headers' => $headers,
                'form_params' => $formParms,
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