<?php

namespace PinpointDesigns\CustomerTestimonial\Block;

use Magento\Framework\View\Element\Template;
use PinpointDesigns\CustomerTestimonial\Api\CustomerTestimonialRepositoryInterface;
use PinpointDesigns\CustomerTestimonial\Api\Data\CustomerTestimonialInterface;

class Listing extends Template
{
    /**
     * @var CustomerTestimonialRepositoryInterface
     */
    private $customerTestimonialRepository;

    public function __construct(
        Template\Context $context,
        CustomerTestimonialRepositoryInterface $customerTestimonialRepository,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->customerTestimonialRepository = $customerTestimonialRepository;
    }

    /**
     * @return CustomerTestimonialInterface[]
     */
    public function getTestimonials(): array
    {
        return $this->customerTestimonialRepository->getPublishedList();
    }

    public function countTestimonials(): int
    {
        return count($this->getTestimonials());
    }
}
