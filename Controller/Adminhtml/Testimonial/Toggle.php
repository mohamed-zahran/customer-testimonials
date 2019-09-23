<?php

namespace PinpointDesigns\CustomerTestimonial\Controller\Adminhtml\Testimonial;

use Magento\Backend\App\Action;
use PinpointDesigns\CustomerTestimonial\Api\CustomerTestimonialRepositoryInterface;

class Toggle extends Action
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
        $testimonialId = (int)$this->getRequest()->getParam('id');

        $this->customerTestimonialRepository->togglePublishStatus($testimonialId);

        $this->messageManager->addSuccessMessage(__('Publish status was toggled successfully'));

        return $this->resultRedirectFactory->create()->setPath('testimonials/testimonial/index');
    }
}
