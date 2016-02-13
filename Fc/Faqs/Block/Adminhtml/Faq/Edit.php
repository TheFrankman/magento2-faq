<?php
namespace Fc\Faqs\Block\Adminhtml\Faq;

class Edit extends \Magento\Backend\Block\Widget\Form\Container
{
    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry = null;

    /**
     * @param \Magento\Backend\Block\Widget\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Widget\Context $context,
        \Magento\Framework\Registry $registry,
        array $data = []
    ) {
        $this->_coreRegistry = $registry;
        parent::__construct($context, $data);
    }

    /**
     * Initialize faq edit block
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_objectId = 'faq_id';
        $this->_blockGroup = 'Fc_Faqs';
        $this->_controller = 'adminhtml_faq';

        parent::_construct();

        if ($this->_isAllowedAction('Fc_Faqs::save')) {
            $this->buttonList->update('save', 'label', __('Save Faq'));
            $this->buttonList->add(
                'saveandcontinue',
                [
                    'label' => __('Save and Continue Edit'),
                    'class' => 'save',
                    'data_attribute' => [
                        'mage-init' => [
                            'button' => ['event' => 'saveAndContinueEdit', 'target' => '#edit_form'],
                        ],
                    ]
                ],
                -100
            );
        } else {
            $this->buttonList->remove('save');
        }

        if ($this->_isAllowedAction('Fc_Faqs::faq_delete')) {
            $this->buttonList->update('delete', 'label', __('Delete Faq'));
        } else {
            $this->buttonList->remove('delete');
        }
    }

    /**
     * Retrieve text for header element depending on loaded faq
     *
     * @return \Magento\Framework\Phrase
     */
    public function getHeaderText()
    {
        if ($this->_coreRegistry->registry('faqs_faq')->getId()) {
            return __("Edit Faq '%1'", $this->escapeHtml($this->_coreRegistry->registry('faqs_faq')->getTitle()));
        } else {
            return __('New Faq');
        }
    }

    /**
     * Check permission for passed action
     *
     * @param string $resourceId
     * @return bool
     */
    protected function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }

    /**
     * Getter of url for "Save and Continue" button
     * tab_id will be replaced by desired by JS later
     *
     * @return string
     */
    protected function _getSaveAndContinueUrl()
    {
        /**
         * @todo check this url is correct
         */
        return $this->getUrl('faqs/*/save', ['_current' => true, 'back' => 'edit', 'active_tab' => '']);
    }
}