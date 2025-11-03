<?php

/**
 * @author      Nexaas Team <dev@nexaas.com>
 * @copyright   2025 Nexaas (http://www.nexxaas.com)
 * @license     http://www.nexaas.com  Copyright
 *
 * @link        http://www.nexaas.com
 *
 */

namespace Braspag\BraspagPagador\Model\Source;

use Magento\Framework\Option\ArrayInterface;

class Sequence implements ArrayInterface
{
    /**
     * @return array
     */
    public function toOptionArray()
    {
        return [
            [
                'value' => 'AnalyseFirst',
                'label' => __('Analyse First'),
            ],
            [
                'value' => 'AuthorizeFirst',
                'label' => __('Authorize First')
            ]
        ];
    }
}