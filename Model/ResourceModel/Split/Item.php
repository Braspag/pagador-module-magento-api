<?php

namespace Braspag\BraspagPagador\Model\ResourceModel\Split;

/**
 * Split Item Resource
 *
 * @author      Nexaas Team <dev@nexaas.com>
 * @copyright   2025 Nexaas (http://www.nexxaas.com)
 * @license     http://www.nexaas.com  Copyright
 *
 * @link        http://www.nexaas.com
 * @codeCoverageIgnore
 */
class Item extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('braspag_paymentsplit_split_item', 'split_item_id');
    }
}