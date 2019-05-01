<?php
/**
 * Copyright © Magenuts Pvt Ltd. All rights reserved.
 * See COPYING.txt for license details.
 * http://www.magenuts.com | support@magenuts.com
 */

namespace Magenuts\Reindex\Block\Adminhtml\System\Config\Form\Field;

use Magento\Config\Block\System\Config\Form\Field;
use Magento\Framework\Data\Form\Element\AbstractElement;

/**
 * Class Link
 * @package Magenuts\Reindex\Block\Adminhtml\System\Config\Form\Field
 */
class Link extends Field
{
    /**
     * Render button
     *
     * @param  AbstractElement $element
     * @return string
     */
    public function render(AbstractElement $element)
    {
        // Remove scope label
        $element->unsScope()->unsCanUseWebsiteValue()->unsCanUseDefaultValue();
        return parent::render($element);
    }

    /**
     * Return element html
     *
     * @param  AbstractElement $element
     * @return string
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    protected function _getElementHtml(AbstractElement $element)
    {
        return sprintf(
            '<a href ="%s">%s</a>',
            $this->_urlBuilder->getUrl('indexer/indexer/list'),
            __('System > Tools > Index Management')
        );
    }
}
