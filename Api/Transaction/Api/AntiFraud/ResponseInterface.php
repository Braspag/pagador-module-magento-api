<?php

/**
 * @author      Nexaas Team <dev@nexaas.com>
 * @copyright   2025 Nexaas (http://www.nexxaas.com)
 * @license     http://www.nexaas.com  Copyright
 *
 * @link        http://www.nexaas.com
 *
 */

namespace Braspag\BraspagPagador\Api\Transaction\Api\AntiFraud;

interface ResponseInterface
{
    public function getId();

    public function getStatus();

    public function getCaptureOnLowRisk();

    public function getVoidOnHighRisk();

    public function getFraudAnalysisReasonCode();

    public function getReplyDataAddressInfoCode();

    public function getReplyDataFactorCode();

    public function getReplyDataScore();

    public function getReplyDataBinCountry();

    public function getReplyDataCardIssuer();

    public function getReplyDataCardScheme();

    public function getReplyDataHostSeverity();

    public function getReplyDataInternetInfoCode();

    public function getReplyDataIpRoutingMethod();

    public function getReplyDataScoreModelUsed();

    public function getReplyDataCasePriority();
}