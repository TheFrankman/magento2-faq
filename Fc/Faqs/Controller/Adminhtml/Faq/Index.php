<?php
namespace Fc\Faqs\Controller\Adminhtml\Faq;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Index extends \Magento\Backend\App\Action
{

    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    /**
     * Index action
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Fc_Faqs::faq');
        $resultPage->addBreadcrumb(__('Faqs'), __('Faqs'));
        $resultPage->addBreadcrumb(__('Manage Faqs'), __('Manage Faqs'));
        $resultPage->getConfig()->getTitle()->prepend(__('Faqs'));

        return $resultPage;
    }

    /**
     * Is the user allowed to view the Faqs grid.
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Fc_Faqs::faq');
    }


}