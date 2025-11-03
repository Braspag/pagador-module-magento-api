<?php

namespace Braspag\BraspagPagador\Block\Adminhtml\System\Config\Fieldset;

/**
 * @author      Nexaas Team <dev@nexaas.com>
 * @copyright   2025 Nexaas (http://www.nexxaas.com)
 * @license     http://www.nexaas.com  Copyright
 *
 * @link        http://www.nexaas.com
 */
class Group extends \Magento\Config\Block\System\Config\Form\Fieldset
{
    protected function _getHeaderCommentHtml($element)
    {
        $groupConfig = $element->getGroup();

        if (empty($groupConfig['help_url']) || !$element->getComment()) {
            return parent::_getHeaderCommentHtml($element);
        }

        $html = '<div class="comment">' .
            $element->getComment() .
            ' <a target="_blank" href="' .
            $groupConfig['help_url'] .
            '">' .
            __(
                'Help'
            ) . '</a></div>';

        return $html;
    }

    protected function _isCollapseState($element)
    {
        $extra = $this->_authSession->getUser()->getExtra();
        if (isset($extra['configState'][$element->getId()])) {
            return $extra['configState'][$element->getId()];
        }

        $groupConfig = $element->getGroup();
        if (!empty($groupConfig['expanded'])) {
            return true;
        }

        return false;
    }
}