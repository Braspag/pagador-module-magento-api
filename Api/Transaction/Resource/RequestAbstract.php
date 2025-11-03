<?php

/**
 * @author      Nexaas Team <dev@nexaas.com>
 * @copyright   2025 Nexaas (http://www.nexxaas.com)
 * @license     http://www.nexaas.com  Copyright
 *
 * @link        http://www.nexaas.com
 *
 */

namespace Braspag\BraspagPagador\Api\Transaction\Resource;

abstract class RequestAbstract
{
    const CONTENT_TYPE_APPLICATION_JSON = 'application/json';
    const CONTENT_TYPE_APPLICATION_X_WWW_FORM_URLENCODED = 'application/x-www-form-urlencoded';

    protected $data;
    protected $params = [];

    abstract protected function prepareParams();

    /**
     * @return array
     */
    public function getParams()
    {
        return $this->params;
    }

    public function getData()
    {
        return $this->data;
    }
}