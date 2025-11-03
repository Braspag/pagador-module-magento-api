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
 * Class BraspagSubordinateStatus
 * @package Braspag\BraspagPagador\Model\Source
 */
class BraspagSubordinateStatus implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * @return array
     */
    public function toOptionArray()
    {
        $options = [];

        foreach ($this->getSubordinateStatuses() as $code => $name) {
            $options[] = ['value' => $code, 'label' => $name];
        }

        return $options;
    }

    /**
     * @return array
     */
    public function getSubordinateStatuses()
    {
        return [
            'UnderAnalysis' => __('UnderAnalysis'),
            'Approved' => __('Approved'),
            'ApprovedWithRestriction' => __('Approved With Restriction'),
            'Rejected' => __('Rejected')
        ];
    }
}