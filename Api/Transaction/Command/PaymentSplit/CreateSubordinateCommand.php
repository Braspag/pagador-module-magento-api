<?php

/**
 * @author      Nexaas Team <dev@nexaas.com>
 * @copyright   2025 Nexaas (http://www.nexxaas.com)
 * @license     http://www.nexaas.com  Copyright
 *
 * @link        http://www.nexaas.com
 *
 */

namespace Braspag\BraspagPagador\Api\Transaction\Command\PaymentSplit;

use Braspag\BraspagPagador\Api\Factories\PaymentSplitOnboardingClientHttpFactory;
use Braspag\BraspagPagador\Api\Factories\ResponseFactory;
use Braspag\BraspagPagador\Api\Factories\PaymentSplitCreateSubordinateFactory;
use Braspag\BraspagPagador\Api\Transaction\Command\CommandAbstract;

/**
 * Class CreateSubordinateCommand
 * @package Braspag\BraspagPagador\Api\Transaction\Command\PaymentSplit
 */
class CreateSubordinateCommand extends CommandAbstract
{
    /**
     * @return $this
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function execute()
    {
        $createSubordinate = PaymentSplitCreateSubordinateFactory::make($this->request);
        $client = PaymentSplitOnboardingClientHttpFactory::make();

        $isTestEnvironment =  (bool) $this->request->getData()->isTestEnvironment();

        $statusCode = 200;
        $errorData = [];

        try {
            $response = $client->request($createSubordinate, 'POST', '', $isTestEnvironment);

            $this->result = ResponseFactory::make(
                $this->getResponseToArray($response),
                'paymentSplitGetSubordinate'
            );
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            if ($e->hasResponse()) {
                $statusCode = $e->getResponse()->getStatusCode();
                $errorData = $this->getNoClassResponseToArray($e->getResponse()->getBody()->getContents());
            }
        }

        if ($statusCode != 200) {
            $this->result = ResponseFactory::make([
                "statusCode" => $statusCode,
                "errorData" => $errorData
            ], 'paymentSplitGetSubordinate');
            return $this;
        }

        return $this;
    }

    /**
     * @param $responseStringJson
     * @param bool $assoc
     * @param int $depth
     * @param int $options
     * @return mixed
     */
    public function getNoClassResponseToArray($responseStringJson, $assoc = true, $depth = 512, $options = 0)
    {
        return \json_decode($responseStringJson, $assoc, $depth, $options);
    }
}