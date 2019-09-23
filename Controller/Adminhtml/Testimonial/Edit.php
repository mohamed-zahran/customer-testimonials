<?php

namespace PinpointDesigns\CustomerTestimonial\Controller\Adminhtml\Testimonial;

use Magento\Backend\App\Action;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Registry;
use PinpointDesigns\CustomerTestimonial\Model\CustomerTestimonial;

class Edit extends Action
{
    /**
     * @var CustomerTestimonial
     */
    private $customerTestimonial;
    /**
     * @var Registry
     */
    private $registry;

    public function __construct(Action\Context $context, CustomerTestimonial $customerTestimonial, Registry $registry)
    {
        parent::__construct($context);
        $this->customerTestimonial = $customerTestimonial;
        $this->registry = $registry;
    }

    public function execute()
    {
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);

        $id = (int)$this->getRequest()->getParam('id');

        $customerTestimonial = $this->customerTestimonial->load($id);

        if ($id && !$customerTestimonial->getId()) {
            $this->messageManager->addErrorMessage(__('Selected customer testimonial does not exist!'));
            return $this->resultRedirectFactory->create()->setPath('testimonials/testimonial/index');
        }

        if ($customerTestimonial->getId()) {
            $resultPage->getConfig()->getTitle()->prepend(__('Edit Testimonial'));
        } else {
            $resultPage->getConfig()->getTitle()->prepend(__('Add Testimonial'));
        }

        $this->registry->register('customer_testimonial', $customerTestimonial);

        return $resultPage;
    }
}
