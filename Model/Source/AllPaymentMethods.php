<?php

namespace Braspag\BraspagPagador\Model\Source;

/**
 *
 * @author      Nexaas Team <dev@nexaas.com>
 * @copyright   2021 Webjump (http://www.nexaas.com)
 * @license     http://www.nexaas.com  Copyright
 *
 * @link        http://www.nexaas.com
 */

/**
 * Class AllPaymentMethods
 * @package Braspag\BraspagPagador\Model\Source
 */
class AllPaymentMethods implements \Magento\Framework\Option\ArrayInterface
{

    protected $scope;

    public function __construct(
        \Magento\Framework\App\Config\ScopeConfigInterface $scope
    ) {
        $this->setScope($scope);
    }

    /**
     * @return mixed
     */
    public function getScope()
    {
        return $this->scope;
    }

    /**
     * @param mixed $scope
     */
    public function setScope($scope)
    {
        $this->scope = $scope;
    }

    /**
     * @return array
     */
    public function toOptionArray()
    {
        $options = [];

        foreach ($this->getPaymentMethods() as $code => $data) {
            if (!isset($data['active']) || $data['active'] !== '1' || $code === 'free') {
                continue;
            }

            $options[] = ['value' => $code, 'label' => !isset($data['title']) ? $code : $data['title']];
        }

        sort($options);

        return $options;
    }

    /**
     * @return mixed
     */
    public function getPaymentMethods()
    {
        return $this->scope->getValue('payment');
    }
}