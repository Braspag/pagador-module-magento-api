<?php

namespace Braspag\BraspagPagador\Model\ResourceModel\CardToken;

use Braspag\BraspagPagador\Model\ResourceModel\CardToken as CardTokenResourceModel;
use Braspag\BraspagPagador\Model\CardToken as CardTokenModel;

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
            CardTokenModel::class,
            CardTokenResourceModel::class
        );
    }
}