<?php

namespace Braspag\BraspagPagador\Model\ResourceModel\Split;

use Braspag\BraspagPagador\Model\ResourceModel\Split as SplitResourceModel;
use Braspag\BraspagPagador\Model\Split as SplitModel;

/**
 * Card Token Collection
 *
 * @author      Nexaas Team <dev@nexaas.com>
 * @copyright   2025 Nexaas (http://www.nexxaas.com)
 * @license     http://www.nexaas.com  Copyright
 *
 * @link        http://www.nexaas.com
 * @codeCoverageIgnore
 */
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init(
            SplitModel::class,
            SplitResourceModel::class
        );
    }
}