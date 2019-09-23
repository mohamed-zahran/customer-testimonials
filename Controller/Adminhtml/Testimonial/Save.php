<?php

namespace PinpointDesigns\CustomerTestimonial\Controller\Adminhtml\Testimonial;

use Magento\Backend\App\Action;
use PinpointDesigns\CustomerTestimonial\Model\CustomerTestimonialFactory;

class Save extends Action
{
    /**
     * @var CustomerTestimonialFactory
     */
    private $customerTestimonialFactory;

    public function __construct(Action\Context $context, CustomerTestimonialFactory $customerTestimonialFactory)
    {
        parent::__construct($context);
        $this->customerTestimonialFactory = $customerTestimonialFactory;
    }

    public function execute()
    {
        $this->customerTestimonialFactory
            ->create()
            ->setData($this->getRequest()->getPostValue()['general'])
            ->save();
        return $this->resultRedirectFactory->create()->setPath('testimonials/testimonial/index');
    }
}
