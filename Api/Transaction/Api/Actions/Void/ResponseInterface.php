<?php

/**
 * @author      Nexaas Team <dev@nexaas.com>
 * @copyright   2025 Nexaas (http://www.nexxaas.com)
 * @license     http://www.nexaas.com  Copyright
 *
 * @link        http://www.nexaas.com
 *
 */

namespace Braspag\BraspagPagador\Api\Transaction\Api\Actions\Void;

interface ResponseInterface
{
    public function getStatus();

    public function getReasonCode();

    public function getReasonMessage();

    public function getProviderReturnCode();

    public function getProviderReturnMessage();

    public function getLinks();
}