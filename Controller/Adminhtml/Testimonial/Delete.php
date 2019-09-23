<?php

namespace PinpointDesigns\CustomerTestimonial\Controller\Adminhtml\Testimonial;

use Magento\Backend\App\Action;
use PinpointDesigns\CustomerTestimonial\Api\CustomerTestimonialRepositoryInterface;

class Delete extends Action
{
    /**
     * @var CustomerTestimonialRepositoryInterface
     */
    private $customerTestimonialRepository;

    public function __construct(Action\Context $context, CustomerTestimonialRepositoryInterface $customerTestimonialRepository)
    {
        parent::__construct($context);

        $this->customerTestimonialRepository = $customerTestimonialRepository;
    }

    public function execute()
    {
        $testimonialId = (int) $this->getRequest()->getParam('id');

        $this->customerTestimonialRepository->delete($testimonialId);

        $this->messageManager->addSuccessMessage(__('Customer testimonial deleted successfully'));

        return $this->resultRedirectFactory->create()->setPath('testimonials/testimonial/index');
    }
}
