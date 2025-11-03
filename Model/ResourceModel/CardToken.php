<?php

namespace Braspag\BraspagPagador\Model\ResourceModel;

/**
 * Card Token Resource
 *
 * @author      Nexaas Team <dev@nexaas.com>
 * @copyright   2025 Nexaas (http://www.nexxaas.com)
 * @license     http://www.nexaas.com  Copyright
 *
 * @link        http://www.nexaas.com
 * @codeCoverageIgnore
 */
class CardToken extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('braspag_braspagpagador_cardtoken', 'entity_id');
    }
}