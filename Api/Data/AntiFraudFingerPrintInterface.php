<?php

/**
 * @author      Nexaas Team <dev@nexaas.com>
 * @copyright   2025 Nexaas (http://www.nexxaas.com)
 * @license     http://www.nexxaas.com  Copyright
 *
 * @link        http://www.nexxaas.com
 *
 */

namespace Braspag\BraspagPagador\Api\Data;

interface AntiFraudFingerPrintInterface
{
    public function getSrcPngImageUrl();

    public function getSrcFlashUrl();

    public function getSrcJsUrl();

    public function getOrgId();

    public function getSessionId();

    public function getAntiFraudProvider();

    public function getClearSaleAppKey();
}