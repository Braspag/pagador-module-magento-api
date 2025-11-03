<?php

namespace Braspag\BraspagPagador\Gateway\Transaction\Base\Resource\SilentOrderPost;

use Braspag\BraspagPagador\Gateway\Transaction\Base\Config\SilentOrderPostConfigInterface;
use Braspag\BraspagPagador\Gateway\Transaction\OAuth2\Resource\Token\Request as OAuth2Request;
use Magento\Payment\Gateway\Http\TransferBuilder;
use Braspag\BraspagPagador\Api\Http\Client\ClientInterface as BraspagClientInterface;
use Braspag\BraspagPagador\Gateway\Transaction\Base\Config\Config as BaseConfig;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Payment\Gateway\Http\ClientInterface;
use Magento\Framework\HTTP\Client\Curl;
use Magento\Framework\Exception\LocalizedException;


class Builder implements BuilderInterface
{
    protected $config;

    protected $transferBuilder;

    protected $client;

    /**
     * @var Curl
     */
    private $curlClient;

    /**
     * @var string
     */
    private $accessToken;

     /**
     * @var OAuth2Request
     */
    private $oAuth2Request;

    /**
     * @var BaseConfig
     */
    protected $baseConfig;

    /**
     * Content type for x-www-form-urlencoded
     */
    const CONTENT_TYPE_APPLICATION_X_WWW_FORM_URLENCODED = 'application/x-www-form-urlencoded';


    public function __construct(
        Curl $curlClient,
        SilentOrderPostConfigInterface $config,
        TransferBuilder $transferBuilder,
        ClientInterface $client,
        OAuth2Request $oAuth2Request,
        BaseConfig $baseConfig
    ) {
        $this->curlClient = $curlClient;
        $this->oAuth2Request = $oAuth2Request;
        $this->baseConfig = $baseConfig;
        $this->setConfig($config);
        $this->setTransferBuilder($transferBuilder);
        $this->setClient($client);
    }


    public function build()
    {

        try {

            $apiURI = BraspagClientInterface::API_URI_OAUTH2;
            $isTestEnvironment =  (bool) $this->baseConfig->getIsTestEnvironment();

            if ($isTestEnvironment === true) {
                $apiURI = BraspagClientInterface::API_URI_OAUTH2_TEST;
            }
    
            $uri = $apiURI . 'oauth2/token';
            $this->curlClient->setOptions([
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_POSTFIELDS => 'grant_type=client_credentials'
            ]);

            $headers = [
                'Content-Type' => self::CONTENT_TYPE_APPLICATION_X_WWW_FORM_URLENCODED,
                'Authorization' => 'Basic '.$this->oAuth2Request->getAccessToken()
            ];

            $this->curlClient->setHeaders($headers);
            $this->curlClient->post($uri, []);

            $response = $this->curlClient->getBody();

            $responseData = json_decode($response, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new LocalizedException(__('Invalid JSON response from Braspag API'));
            }

            $url = $this->getConfig()->getAccessTokenUrl();
            $headers = [
                'MerchantId' => $this->baseConfig->getMerchantId(),
                'Authorization' => 'Bearer ' . $responseData['access_token']
            ];

            try {
                $this->curlClient->setOption(CURLOPT_RETURNTRANSFER, true);
                $this->curlClient->setOption(CURLOPT_MAXREDIRS, 10);
                $this->curlClient->setOption(CURLOPT_TIMEOUT, 0);
                $this->curlClient->setOption(CURLOPT_FOLLOWLOCATION, true);
                $this->curlClient->setOption(CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
                $this->curlClient->setHeaders($headers);

                $this->curlClient->post($url, []);

                $response = $this->curlClient->getBody();
                $responseData = json_decode($response, true);
                return $responseData['AccessToken'];
            } catch (\Exception $e) {
                throw new \Exception('Error making API request: ' . $e->getMessage());
            }

            return $responseData['access_token'];
        } catch (\Exception $e) {
            throw new LocalizedException(__('Failed to retrieve token: %1', $e->getMessage()));
        }
    }

    protected function getClient()
    {
        return $this->client;
    }

    protected function setClient($client)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * @return SilentOrderPostConfigInterface
     */
    protected function getConfig()
    {
        return $this->config;
    }

    protected function setConfig($config)
    {
        $this->config = $config;

        return $this;
    }

    /**
     * @return TransferBuilder
     */
    protected function getTransferBuilder()
    {
        return $this->transferBuilder;
    }

    protected function setTransferBuilder($transferBuilder)
    {
        $this->transferBuilder = $transferBuilder;

        return $this;
    }
}
